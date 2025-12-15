<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // read
    public function index()
    {
        return response()->json(Kategori::all());
    }

    // read by id
    public function show($id)
    {
        $kategori = Kategori::find($id);

        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($kategori);
    }

    // create
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategori = Kategori::create($data);

        return response()->json([
            'message' => 'Kategori berhasil dibuat',
            'data' => $kategori,
        ], 201);
    }

    // update
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_kategori' => 'required|string',
        ]);

        $kategori->update($data);

        return response()->json([
            'message' => 'Kategori berhasil diupdate',
            'data' => $kategori,
        ]);
    }

    // delete
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $kategori->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
