<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // GET /api/produk/read
    public function index()
    {
        // ikutkan relasi kategori & pelanggan biar kelihatan
        $produk = Produk::with(['kategori', 'pelanggan'])->get();

        return response()->json($produk);
    }

    // POST /api/produk/create
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_produk' => 'required|string',
            'harga_produk' => 'required|integer',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
        ]);

        $produk = Produk::create($data);

        return response()->json([
            'message' => 'Produk berhasil dibuat',
            'data' => $produk,
        ], 201);
    }

    // PUT /api/produk/update/{id}
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_produk' => 'sometimes|required|string',
            'harga_produk' => 'sometimes|required|integer',
            'id_kategori' => 'sometimes|required|exists:kategori,id_kategori',
            'id_pelanggan' => 'sometimes|required|exists:pelanggan,id_pelanggan',
        ]);

        $produk->update($data);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $produk,
        ]);
    }

    // DELETE /api/produk/delete/{id}
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
