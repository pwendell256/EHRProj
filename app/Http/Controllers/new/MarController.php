<?php

namespace App\Http\Controllers\new;

use App\Models\MAR;
use App\Models\Martime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MarController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'med' => 'nullable|string',
            'dosage' => 'nullable|string',
            'route' => 'nullable|string',
            'time' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $validated['patient_Id'] = $id;

        MAR::create($validated);

        return redirect()->back()->with('success', 'MAR data inserted Successfully');
    }

    public function martimestore(Request $request, $id)
    {

        $validated = $request->validate([
            'date' => 'nullable|date',
            'time' => 'nullable|string',
            'adm' => 'nullable|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // More specific image validation
        ]);

        $signaturePath = null;

        if ($request->hasFile('path')) {
            $signaturePath = $request->file('path')->store('mar/signatures', 'public');
            $validated['path'] = $signaturePath;
        }

        $martime = new Martime();
        $martime->mar_Id = $id;
        $martime->date = $validated['date'];
        $martime->time = $validated['time'];
        $martime->adm = $validated['adm'];
        $martime->path = $signaturePath;

        $martime->save();
        return redirect()->back()->with('success', 'martime data inserted Successfully');
    }

    public function update(Request $request,  MAR $id)
    {
        $validated = $request->validate([
            'med' => 'nullable|string',
            'dosage' => 'nullable|string',
            'route' => 'nullable|string',
            'time' => 'nullable|string',
            'note' => 'nullable|string',
        ]);

        $id->update($validated);
        return redirect()->back()->with('success', 'MAR data updated Successfully');
    }

    public function martimeupdate(Request $request, Martime $id)
    {


        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'adm' => 'nullable|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // More specific image validation
        ]);

        if ($request->hasFile('path')) {
            // Delete old signature file if it exists
            if ($id->path && Storage::disk('public')->exists($id->path)) {
                Storage::disk('public')->delete($id->path);
            }

            $signaturePath = $request->file('path')->store('mar/signatures', 'public');
            $validated['path'] = $signaturePath;
        }

        $id->update($validated);
        return redirect()->back()->with('success', 'MARtime data updated Successfully');
    }

    public function destroy(MAR $id)
    {

        foreach ($id->martimes as $martime) {
            if ($martime->path && Storage::disk('public')->exists($martime->path)) {
                Storage::disk('public')->delete($martime->path);
            }
        }

        $id->delete();
        return redirect()->back()->with('success', 'MAR data deleted Successfully');
    }

    public function martimedestroy(Martime $id)
    {


        if ($id->path && Storage::disk('public')->exists($id->path)) {
            Storage::disk('public')->delete($id->path);
        }

        $id->delete();
        return redirect()->back()->with('success', 'MAR data deleted Successfully');
    }
}
