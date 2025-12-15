<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // read
    public function index()
    {
        $produk = Produk::with(['kategori', 'pelanggan'])->get();

        return response()->json($produk);
    }

    // read by id
    public function show($id)
    {
        $produk = Produk::with(['kategori', 'pelanggan'])->find($id);

        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json($produk);
    }

    // create
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

    // update
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

    // delete
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
