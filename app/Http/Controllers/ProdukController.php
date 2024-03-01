<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //DIGUNAKAN UNTUK MENAMPILKAN DATA PRODUK
         $p = Produk::all();
         if (isset($p)) {
             $hasil = [
                 'success' => true,
                 'message' => 'Data Produk',
                 'data' => $p
             ];
             return response()->json($hasil, 200);
         } else {
             $fails = [
                 'success' => false,
                 'message' => 'Data Produk Tidak Ditemukan',
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
        // Digunakan untuk menambahkan data Produk baru
        $data = [
            'nama' => 'required',
            'stok' => 'required | integer',
            'harga' => 'required | integer',
            'idjenis' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Data Produk",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $p = new Produk();
            $p->nama = $request->nama;
            $p->stok = $request->stok;
            $p->harga = $request->harga;
            $p->idjenis = $request->idjenis;
            $p->save();
            $success = [
                "message" => "Data Produk Berhasil Ditambahkan",
                "data" => $p
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
      // DIGUNAKAN UNTUK MEMPERBARUI DATA Produk
      $validator = Validator::make($request->all(), [
        'nama' => 'string|max:64',
        'stok' => 'integer',
        'harga' => 'integer',
        'idjenis' => 'integer',
      ]);

      if ($validator->fails()) {
        $fails = [
          "message" => "Gagal Memperbarui Data Produk",
          "data" => $validator->errors()
        ];
        return response()->json($fails, 404);
      }

      $p = Produk::find($id);
      if ($p) {
        $p->update($request->all()); 
        $success = [
          "message" => "Data Produk Berhasil Diupdate",
          "data" => $p
        ];
        return response()->json($success, 200);
      } else {
        $fails = [
          "message" => "Data Produk Tidak Ditemukan",
        ];
        return response()->json($fails, 404);
      }
    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA PRODUK
        $p = Produk::where('id', $id)->first();
        if (isset($p)) {
            $p->delete();
            $success = [
                'success' => true,
                'message' => 'Data Produk Berhasil dihapus',
                'data' => $p
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Produk Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
