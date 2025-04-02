<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function update(Request $request, History $id)
    {
        $request->validate([
            'history' => 'nullable|string',
            'past' => 'nullable|string',
            'family' => 'nullable|string',
            'birth' => 'nullable|string',
            'environment' => 'nullable|string',
            'dietary' => 'nullable|string',
            'review' => 'nullable|string',
        ]);


        $id->update($request->all());

        return redirect()->back()->with('success', 'history Updated Successfully');
    }
}
