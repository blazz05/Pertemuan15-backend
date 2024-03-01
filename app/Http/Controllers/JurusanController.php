<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA JURUSAN
        $jurusan = Jurusan::all();
        if (isset($jurusan)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Jurusan',
                'data' => $jurusan
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jurusan Tidak Ditemukan',
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
        // Digunakan untuk menambahkan data jurusan baru
        $data = [
            'nama_jurusan' => 'required',
            'singkatan_jurusan' => 'required',
            'jumlah_mahasantri' => 'required | integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal Menambahkan Data Jurusan",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $jurusan = new Jurusan();
            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->singkatan_jurusan = $request->singkatan_jurusan;
            $jurusan->jumlah_mahasantri = $request->jumlah_mahasantri;
            $jurusan->save();
            $success = [
                "message" => "Data Jurusan Berhasil Ditambahkan",
                "data" => $jurusan
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
      // DIGUNAKAN UNTUK MEMPERBARUI DATA JURUSAN
      $validator = Validator::make($request->all(), [
        'nama_jurusan' => 'string|max:64',
        'singkatan_jurusan' => 'string',
        'jumlah_mahasantri' => 'integer',
      ]);

      if ($validator->fails()) {
        $fails = [
          "message" => "Gagal Memperbarui Data Jurusan",
          "data" => $validator->errors()
        ];
        return response()->json($fails, 404);
      }

      $jurusan = Jurusan::find($id);
      if ($jurusan) {
        $jurusan->update($request->all()); 
        $success = [
          "message" => "Data Jurusan Berhasil Diupdate",
          "data" => $jurusan
        ];
        return response()->json($success, 200);
      } else {
        $fails = [
          "message" => "Data Jurusan Tidak Ditemukan",
        ];
        return response()->json($fails, 404);
      }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA JURUSAN
        $jurusan = Jurusan::where('id', $id)->first();
        if (isset($jurusan)) {
            $jurusan->delete();
            $success = [
                'success' => true,
                'message' => 'Data Jurusan Berhasil dihapus',
                'data' => $jurusan
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Jurusan Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
