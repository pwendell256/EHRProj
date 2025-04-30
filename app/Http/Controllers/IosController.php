<?php

namespace App\Http\Controllers;

use App\Models\Ios;
use App\Models\Iostime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IosController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'nullable',
            'shift' => 'nullable',
            'status' => 'nullable',
            'time' => 'nullable',
            'amount' => 'nullable',
            'source' => 'nullable',
        ]);

        $existingIos = Ios::where('patient_Id', $id)
            ->where('date', $validated['date'])
            ->where('shift', $validated['shift'])
            ->where('status', $validated['status'])
            ->first();

        if ($existingIos) {

            $iostime = new Iostime();
            $iostime->ios_Id  = $existingIos->id;
            $iostime->time = $validated['time'];
            $iostime->amount = $validated['amount'];
            $iostime->source = $validated['source'];
            $iostime->save();

            return redirect()->back();
        } else {


            $ios = new Ios();
            $ios->patient_Id = $id;
            $ios->date = $validated['date'];
            $ios->shift = $validated['shift'];
            $ios->status = $validated['status'];
            $ios->save();

            $iostime = new Iostime();
            $iostime->ios_Id  = $ios->id;
            $iostime->time = $validated['time'];
            $iostime->amount = $validated['amount'];
            $iostime->source = $validated['source'];
            $iostime->save();
        }
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {

        $io = Ios::findOrFail($request->id);
        $io->total = $request->total;

        // Handle signature upload
        if ($request->hasFile('signature')) {
            // Store the new signature file
            $path = $request->file('signature')->store('io/signatures', 'public');

            // Delete old file if exists
            if ($io->signature && Storage::disk('public')->exists($io->signature)) {
                Storage::disk('public')->delete($io->signature);
            }

            // Update the signature URL
            $io->signature= $path;
        }
        // Handle signature removal
        elseif ($request->has('remove_signature')) {
            // Delete the signature file if it exists
            if ($io->signature && Storage::disk('public')->exists($io->signature)) {
                Storage::disk('public')->delete($io->signature);
            }
            $io->signature = null;
        }

        // Save the changes
        $io->save();

        return redirect()->back();
    }

    public function deletegroup(Ios $id){

        if ($id->signature && Storage::disk('public')->exists($id->signature)) {
            Storage::disk('public')->delete($id->signature);
        }

        $id->delete();

        return redirect()->back();
    }
}
