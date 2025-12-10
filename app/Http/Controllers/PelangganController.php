<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // GET /api/pelanggan/read
    public function index()
    {
        return response()->json(Pelanggan::all());
    }

    // POST /api/pelanggan/create
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pelanggan' => 'required|string',
            'email_pelanggan' => 'required|email|unique:pelanggan,email_pelanggan',
            'no_telepon_pelanggan' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::create($data);

        return response()->json([
            'message' => 'Pelanggan berhasil dibuat',
            'data' => $pelanggan,
        ], 201);
    }

    // PUT /api/pelanggan/update/{id}
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        if (! $pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'nama_pelanggan' => 'sometimes|required|string',
            'email_pelanggan' => 'sometimes|required|email|unique:pelanggan,email_pelanggan,' . $id . ',id_pelanggan',
            'no_telepon_pelanggan' => 'sometimes|nullable|string',
        ]);

        $pelanggan->update($data);

        return response()->json([
            'message' => 'Pelanggan berhasil diupdate',
            'data' => $pelanggan,
        ]);
    }

    // DELETE /api/pelanggan/delete/{id}
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        if (! $pelanggan) {
            return response()->json(['message' => 'Pelanggan tidak ditemukan'], 404);
        }

        $pelanggan->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus']);
    }
}
