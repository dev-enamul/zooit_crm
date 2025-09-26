<?php

use App\Models\ProjectProposalSection;
use Illuminate\Support\Facades\Log;

try {
    $sections = ProjectProposalSection::all();
    foreach ($sections as $section) {
        $value = $section->value;
        $updated = false;

        // Fix items
        if (isset($value['items']) && is_string($value['items'])) {
            $value['items'] = json_decode($value['items'], true) ?? [];
            $updated = true;
        }

        // Fix payment_terms
        if (isset($value['payment_terms']) && is_string($value['payment_terms'])) {
            $value['payment_terms'] = json_decode($value['payment_terms'], true) ?? [];
            $updated = true;
        }

        // Fix signature_area
        if (isset($value['signature_area']) && is_string($value['signature_area'])) {
            $value['signature_area'] = json_decode($value['signature_area'], true) ?? [];
            $updated = true;
        }

        // Fix nested sub_sections.items
        if (isset($value['sub_sections'])) {
            foreach ($value['sub_sections'] as $subIndex => $subSection) {
                if (isset($subSection['items']) && is_string($subSection['items'])) {
                    $value['sub_sections'][$subIndex]['items'] = json_decode($subSection['items'], true) ?? [];
                    $updated = true;
                }
                if (isset($subSection['sub_sections'])) {
                    foreach ($subSection['sub_sections'] as $subSubIndex => $subSubSection) {
                        if (isset($subSubSection['items']) && is_string($subSubSection['items'])) {
                            $value['sub_sections'][$subIndex]['sub_sections'][$subSubIndex]['items'] = json_decode($subSubSection['items'], true) ?? [];
                            $updated = true;
                        }
                    }
                }
            }
        }

        if ($updated) {
            $section->value = $value;
            $section->save();
            Log::info("Fixed stringified data for section ID {$section->id}");
        }
    }
    echo "Database fixed successfully.\n";
} catch (\Exception $e) {
    Log::error("Error fixing database: " . $e->getMessage());
    echo "Error: " . $e->getMessage() . "\n";
}