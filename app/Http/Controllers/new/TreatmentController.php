<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function update(Request $request, Treatment $id){
        $validate = $request->validate([
            'short_term' => 'nullable|string',
            'long_term' => 'nullable|string',
            'medication' => 'nullable|string',
            'intervention' => 'nullable|string',
        ]);

        $id->update($validate);

        return redirect()->back();
    }
}
