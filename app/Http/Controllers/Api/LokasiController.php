<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Lokasi::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'remaks' => 'nullable|string',

        ]);

        $product = Lokasi::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lokasi = Lokasi::find($id);
        if (!$lokasi) return response()->json(['message' => 'Lokasi not found'], 404);

        return response()->json($lokasi);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasi = Lokasi::find($id);
        if (!$lokasi) return response()->json(['message' => 'lokasi not found'], 404);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'remaks' => 'nullable|string',

        ]);

        $lokasi->update($validated);
        return response()->json($lokasi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lokasi = Lokasi::find($id);
        if (!$lokasi) return response()->json(['message' => 'Lokasi not found'], 404);

        $lokasi->delete();
        return response()->json(null, 204);
    }
}
