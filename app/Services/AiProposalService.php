<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ProjectProposalSection;

class AiProposalService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function ask($proposalData, $prompt)
    {
        if (!$this->apiKey) {
            throw new \Exception('GEMINI_API_KEY is not set in the .env file.');
        }

        if (!$proposalData || !$prompt) {
            throw new \Exception('Missing proposal data or prompt');
        }

        try {
            $client = Http::withHeaders(['Content-Type' => 'application/json']);

            $system_prompt = <<<'EOT'
            You are a highly intelligent and precise proposal editor. Your task is to act as a backend API that modifies a JSON object representing a project proposal based on a user's instruction.

            **CRITICAL INSTRUCTIONS:**
            1.  You will be given a user's `prompt` and the full `proposal_data` in JSON format.
            2.  First, you MUST carefully analyze the user's `prompt` to identify which `section` they want to modify. The section title is the primary identifier.
            3.  You MUST ONLY modify the section the user has specified. Do NOT modify any other part of the proposal.
            4.  Your response MUST be a valid JSON object containing ONLY the `sections` array with the single, modified section object inside it.
            5.  Preserve the original structure, keys, and `id` of the modified section.
            6.  If the user's prompt is ambiguous or it's unclear which section to modify, you should not make any changes and return an empty `sections` array.
            7.  **Handle Calculations:** If the user's prompt involves changing a price or value that affects a total (e.g., changing a `frontend_price` in `core_features`), you MUST recalculate and update all related total fields (`core_features_total_frontend`, `core_features_total_backend`, `total_development_cost`). Ensure the currency format (e.g., "BDT", ",") is preserved.
            8.  **Intelligent Goal Seeking:** If the user asks to change a total (e.g., "Set the total development cost to 2,000,000 BDT"), you must intelligently adjust the underlying prices to meet that goal. You should distribute the change proportionally among the relevant items. For example, if increasing the total cost, you should increase the prices of the individual features. Always ensure the final calculated total matches the user's requested total.

            **Example 1: Direct Price Change**
            **User Prompt:** "In the 'Costing Breakdown' section, change the frontend price of 'UI/UX Design' to 3,50,000 BDT."
            **Your CORRECT Response (JSON only):**
            ```json
            {
                "sections": [
                    {
                        "id": 38,
                        "title": "Costing Breakdown",
                        "value": {
                            "core_features": [
                                { "functionality": "UI/UX Design", "frontend_price": "3,50,000 BDT", "backend_price": "", "note": "One Time" },
                                { "functionality": "Product Catalog", "frontend_price": "70,000 BDT", "backend_price": "80,000 BT", "note": "One Time" }
                            ],
                            "core_features_total_frontend": "7,10,000 BDT",
                            "core_features_total_backend": "7,70,000 BDT",
                            "total_development_cost": "14,80,000 BDT"
                        }
                    }
                ]
            }
            ```

            **Example 2: Goal Seeking**
            **User Prompt:** "In the 'Costing Breakdown' section, set the total development cost to 1,500,000 BDT."
            **Your CORRECT Response (JSON only):**
            ```json
            {
                "sections": [
                    {
                        "id": 38,
                        "title": "Costing Breakdown",
                        "value": {
                            "core_features": [
                                {"functionality": "UI/UX Design", "frontend_price": "3,07,692 BDT", "backend_price": "", "note": "One Time"},
                                {"functionality": "Product Catalog", "frontend_price": "71,795 BDT", "backend_price": "82,051 BDT", "note": "One Time"}
                            ],
                            "core_features_total_frontend": "...",
                            "core_features_total_backend": "...",
                            "total_development_cost": "1,500,000 BDT"
                        }
                    }
                ]
            }
            ```
            **DO NOT** return other sections. Your response must be clean and contain only the modified section.
EOT;

            $user_prompt = json_encode([
                'prompt' => $prompt,
                'proposal_data' => $proposalData
            ]);

            $response = $client->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$this->apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $system_prompt],
                            ['text' => $user_prompt],
                        ]
                    ]
                ]
            ]);

            if ($response->failed()) {
                Log::error('Gemini API request failed', ['response' => $response->json()]);
                throw new \Exception('Failed to communicate with AI service.');
            }

            $result = $response->json();
            $jsonString = $result['candidates'][0]['content']['parts'][0]['text'];
            $jsonString = str_replace(['```json', '```'], '', $jsonString);
            $updatedData = json_decode(trim($jsonString), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Failed to decode JSON from Gemini API', ['response' => $jsonString, 'error' => json_last_error_msg()]);
                throw new \Exception('AI returned invalid data format.');
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

            return $updatedData;

        } catch (\Exception $e) {
            Log::error('Error in askAi method', ['exception' => $e]);
            throw $e;
        }
    }
}