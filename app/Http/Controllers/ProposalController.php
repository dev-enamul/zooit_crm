<?php

namespace App\Http\Controllers;

use App\Models\ProjectProposal;
use App\Models\ProjectProposalSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class ProposalController extends Controller
{
    public function index($id)
    {
        $proposal = ProjectProposal::with(['customer', 'user', 'sections'])
            ->findOrFail($id);

        $proposalJson = $proposal->toJson();

        return view('proposal.proposal_view', compact('proposal', 'proposalJson'));
    }

    public function updateField(Request $request)
    {
        $modelName = $request->input('model');
        $id = $request->input('id');
        $field = $request->input('field');
        $value = $request->input('value');

        if (!$modelName || !$id || !$field) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }

        try {
            if ($modelName === 'proposal') {
                $model = ProjectProposal::findOrFail($id);
                $model->$field = $value;
                $model->save();
            } elseif ($modelName === 'section') {
                $model = ProjectProposalSection::findOrFail($id);

                // Handle direct attributes
                if (in_array($field, ['title'])) {
                    $model->$field = $value;
                } else {
                    // Handle 'value' as JSON/array
                    $jsonValue = is_array($model->value) ? $model->value : (json_decode($model->value, true) ?? []);

                    // If field is for a list item (e.g., items.9, payment_terms.9)
                    if (preg_match('/^(items|payment_terms|signature_area)\.\d+$/', $field)) {
                        $baseField = explode('.', $field)[0]; // e.g., items
                        $index = explode('.', $field)[1]; // e.g., 9
                        $currentItems = Arr::get($jsonValue, $baseField, []);
                        $currentItems[$index] = $value; // Update specific item
                        Arr::set($jsonValue, $baseField, array_values($currentItems)); // Reindex array
                    }
                    // If field is for a list (e.g., items, payment_terms, timeline)
                    elseif (in_array($field, ['items', 'payment_terms', 'timeline', 'core_features', 'additional_modules', 'signature_area']) || strpos($field, 'items') !== false) {
                        if (is_string($value)) {
                            $decodedValue = json_decode($value, true);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                Log::error("Invalid JSON for field {$field}: " . $value);
                                return response()->json(['error' => 'Invalid JSON value provided', 'details' => json_last_error_msg()], 400);
                            }
                            Arr::set($jsonValue, $field, $decodedValue);
                        } else {
                            Arr::set($jsonValue, $field, $value);
                        }
                    } else {
                        Arr::set($jsonValue, $field, $value);
                    }

                    $model->value = $jsonValue;
                    $model->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Field updated successfully']);
        } catch (\Exception $e) {
            Log::error("Error updating proposal field: " . $e->getMessage(), [
                'modelName' => $modelName,
                'id' => $id,
                'field' => $field,
                'value' => $value,
                'exception' => $e
            ]);
            return response()->json(['error' => 'Failed to update field: ' . $e->getMessage()], 500);
        }
    }

    public function askAi(Request $request)
    {
        $proposalData = $request->input('proposal_data');
        $prompt = $request->input('prompt');

        if (!$proposalData || !$prompt) {
            return response()->json(['error' => 'Missing proposal data or prompt'], 400);
        }

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'GEMINI_API_KEY is not set in the .env file.'], 500);
        }

        try {
            $client = \Illuminate\Support\Facades\Http::withToken($apiKey)
                ->withHeaders(['Content-Type' => 'application/json']);

            $system_prompt = <<<'EOT'
            You are an expert proposal editor. You will be given a JSON object representing a project proposal. 
            The user will provide a prompt with instructions on what to change.
            Your task is to modify the JSON data according to the user's prompt and return ONLY the modified sections in the exact same JSON format.
            Do not return sections that were not changed. Do not add new top-level keys. Preserve the original structure and keys of each section.
            If the user asks to add a new item to a list (like 'items' or 'core_features'), add it. If they ask to remove one, remove it. If they ask to change text, change it.
            Your response must be a valid JSON object containing only the 'sections' that you have modified.
            Example Input:
            {
                "prompt": "Change the title of the introduction to 'Welcome' and add a new item to its list.",
                "proposal": { ... proposal data ... },
                "customer": { ... customer data ... },
                "sections": [
                    { "id": 1, "title": "Introduction", "value": { "content": "...", "items": ["Item 1"] } },
                    { "id": 2, "title": "Pricing", "value": { ... } }
                ]
            }
            Example Output (JSON only):
            {
                "sections": [
                    { "id": 1, "title": "Welcome", "value": { "content": "...", "items": ["Item 1", "New Item"] } }
                ]
            }
EOT;

            $response = $client->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $system_prompt],
                            ['text' => "Here is the proposal data and the user prompt: " . json_encode($proposalData)],
                        ]
                    ]
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API request failed', ['response' => $response->json()]);
                return response()->json(['error' => 'Failed to communicate with AI service.', 'details' => $response->body()], 500);
            }

            $result = $response->json();
            $jsonString = $result['candidates'][0]['content']['parts'][0]['text'];
            $jsonString = str_replace(['```json', '```'], '', $jsonString);
            $updatedData = json_decode(trim($jsonString), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Failed to decode JSON from Gemini API', ['response' => $jsonString, 'error' => json_last_error_msg()]);
                return response()->json(['error' => 'AI returned invalid data format.', 'details' => $jsonString], 500);
            }

            if (isset($updatedData['sections'])) {
                foreach ($updatedData['sections'] as $sectionData) {
                    $section = ProjectProposalSection::find($sectionData['id']);
                    if ($section) {
                        if (isset($sectionData['title'])) {
                            $section->title = $sectionData['title'];
                        }
                        if (isset($sectionData['value'])) {
                            $section->value = $sectionData['value'];
                        }
                        $section->save();
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'Proposal updated by AI.']);

        } catch (\Exception $e) {
            Log::error('Error in askAi method', ['exception' => $e]);
            return response()->json(['error' => 'An internal error occurred: ' . $e->getMessage()], 500);
        }
    }

}
