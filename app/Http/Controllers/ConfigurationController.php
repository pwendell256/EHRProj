<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConfigurationController extends Controller
{
    public function index(){
        $config = Configuration::first();
        return Inertia::render('Auth/Configuration/Config', ['config' => $config]);
    }

    public function update(Request $request, Configuration $id){
        $validated = $request->validate([
            'imaging' => 'nullable|integer',
            'laboratory' => 'nullable|integer',
            'histopath' => 'nullable|integer',
            'microbiology' => 'nullable|integer',
            'specialtest' => 'nullable|integer',
        ]);

        $id->update($validated);

        return redirect()->back();
        
    }
}
