<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // GET /api/kategori/read
    public function index()
    {
        return response()->json(Kategori::all());
    }

    // POST /api/kategori/create
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

    // PUT /api/kategori/update/{id}
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

    // DELETE /api/kategori/delete/{id}
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
