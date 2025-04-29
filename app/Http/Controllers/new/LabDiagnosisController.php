<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LabDiagnosis;
use Illuminate\Support\Facades\Storage;

class LabDiagnosisController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'wbc' => 'nullable|numeric',
            'rbc' => 'nullable|numeric',
            'hemoglobin' => 'nullable|numeric',
            'hematocrit' => 'nullable|numeric',
            'mcv' => 'nullable|numeric',
            'mch' => 'nullable|numeric',
            'mchc' => 'nullable|numeric',
            'rbc_width' => 'nullable|numeric',
            'platelet_count' => 'nullable|numeric',

            'neutrophils' => 'nullable|numeric',
            'lymphocytes' => 'nullable|numeric',
            'monocytes' => 'nullable|numeric',
            'eosinophils' => 'nullable|numeric',
            'basophils' => 'nullable|numeric',

            'chest_pa' => 'nullable|string',
            'impression' => 'nullable|string',
            'advice' => 'nullable|string',
            'advice_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'xray_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'uri_date' => 'nullable|date',
            'uri_time' => 'nullable',
            'transparency' => 'nullable|string',
            'color' => 'nullable|string',
            'sp_gravity' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
            'protein' => 'nullable|string',
            'glucose' => 'nullable|string',
            'bilirubin' => 'nullable|string',
            'ery_hb' => 'nullable|string',
            'leukocytes' => 'nullable|string',
            'nitrite' => 'nullable|string',
            'urobilinogen' => 'nullable|string',
            'ketone' => 'nullable|string',
        ]);

        $labDiagnosis = LabDiagnosis::findOrFail($id);

        // Handle image upload or removal
        if ($request->hasFile('advice_path')) {
            // Delete old image if it exists
            if ($labDiagnosis->advice_path) {
                Storage::disk('public')->delete($labDiagnosis->advice_path);
            }

            // Store the new image
            $validated['advice_path'] = $request->file('advice_path')->store('LabDiagnosis/Advice', 'public');
        } else if ($request->has('advice_path') && $request->advice_path === null) {
            // If advice_path is explicitly set to null, remove the image
            if ($labDiagnosis->advice_path) {
                Storage::disk('public')->delete($labDiagnosis->advice_path);
            }
            $validated['advice_path'] = null;
        } else {
            // If no new file and not explicitly set to null, don't change the path
            unset($validated['advice_path']);
        }


        if ($request->hasFile('xray_path')) {
            // Delete old image if it exists
            if ($labDiagnosis->xray_path) {
                Storage::disk('public')->delete($labDiagnosis->xray_path);
            }

            // Store the new image
            $validated['xray_path'] = $request->file('xray_path')->store('LabDiagnosis/Xray', 'public');
        } else if ($request->has('xray_path') && $request->xray_path === null) {
            // If advice_path is explicitly set to null, remove the image
            if ($labDiagnosis->xray_path) {
                Storage::disk('public')->delete($labDiagnosis->xray_path);
            }
            $validated['xray_path'] = null;
        } else {
            // If no new file and not explicitly set to null, don't change the path
            unset($validated['xray_path']);
        }


        $labDiagnosis->update($validated);

        return redirect()->back()->with('success', 'Lab diagnosis updated successfully');
    }
}