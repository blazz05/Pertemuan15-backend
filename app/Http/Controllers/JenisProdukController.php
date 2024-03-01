<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisProduk;
use Illuminate\Support\Facades\Validator;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA JENIS PRODUK
        $jp = JenisProduk::all();
        if (isset($jp)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Jenis Produk',
                'data' => $jp
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
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
        // Digunakan untuk menambahkan data JenisProduk baru
        $data = [
            'nama' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Data JenisProduk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $jp = new JenisProduk();
            $jp->nama = $request->nama;
            $jp->save();
            $success = [
                "message" => "Data JenisProduk Berhasil Ditambahkan",
                "data" => $jp
            ];
            return response()->json($success, 200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
      // DIGUNAKAN UNTUK MEMPERBARUI DATA JenisProduk
      $validator = Validator::make($request->all(), [
        'nama' => 'string|max:64',
      ]);

      if ($validator->fails()) {
        $fails = [
          "message" => "Gagal Memperbarui Data JenisProduk",
          "data" => $validator->errors()
        ];
        return response()->json($fails, 404);
      }

      $jp = JenisProduk::find($id);
      if ($jp) {
        $jp->update($request->all()); 
        $success = [
          "message" => "Data JenisProduk Berhasil Diupdate",
          "data" => $jp
        ];
        return response()->json($success, 200);
      } else {
        $fails = [
          "message" => "Data JenisProduk Tidak Ditemukan",
        ];
        return response()->json($fails, 404);
      }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA JENIS PRODUK
        $jp = JenisProduk::where('id', $id)->first();
        if (isset($jp)) {
            $jp->delete();
            $success = [
                'success' => true,
                'message' => 'Data Jenis Produk Berhasil dihapus',
                'data' => $jp
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jenis Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
