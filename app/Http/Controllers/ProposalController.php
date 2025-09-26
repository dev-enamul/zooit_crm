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

        return view('proposal.proposal_view', compact('proposal'));
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

}
