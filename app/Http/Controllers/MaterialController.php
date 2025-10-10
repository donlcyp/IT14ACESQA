<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('qa_materials', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'batch' => 'nullable|string',
            'supplier' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'date_received' => 'nullable|date',
            'date_inspected' => 'nullable|date',
            'status' => 'required|string',
            'location' => 'nullable|string',
        ]);

        Material::create($validated);

        return redirect()->route('materials.index')->with('success', 'Material added successfully!');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted!');
    }
}
