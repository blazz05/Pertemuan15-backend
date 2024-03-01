<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //DIGUNAKAN UNTUK MENAMPILKAN DATA MAHASANTRI
        $mhs = Mahasantri::all();
        if (isset($mhs)) {
            $hasil = [
                'success' => true,
                'message' => 'Data Mahasantri',
                'data' => $mhs
            ];
            return response()->json($hasil, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Mahasantri Tidak Ditemukan',
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
        // Digunakan untuk menambahkan data mahasantri baru
        $data = [
            'nama_mhs' => 'required',
            'alamat_mhs' => 'required',
            'umur_mhs' => 'required | integer',
            'id_jrs' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $data);

        if ($validator->fails()) {
            $fails = [
                "message" => "Gagal MenambahkanData Mahasantri",
                "data" => $validator->errors()
            ];
            return response()->json($fails, 404);
        } else {
            $mhs = new Mahasantri();
            $mhs->nama_mhs = $request->nama_mhs;
            $mhs->alamat_mhs = $request->alamat_mhs;
            $mhs->umur_mhs = $request->umur_mhs;
            $mhs->id_jrs = $request->id_jrs;
            $mhs->save();
            $success = [
                "message" => "Data Mahasantri Berhasil Ditambahkan",
                "data" => $mhs
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
      // DIGUNAKAN UNTUK MEMPERBARUI DATA MAHASANTRI
      $validator = Validator::make($request->all(), [
        'nama_mhs' => 'string|max:64',
        'alamat_mhs' => 'string',
        'umur_mhs' => 'integer',
        'id_jrs' => 'integer',
      ]);

      if ($validator->fails()) {
        $fails = [
          "message" => "Gagal Memperbarui Data Mahasantri",
          "data" => $validator->errors()
        ];
        return response()->json($fails, 404);
      }

      $mhs = Mahasantri::find($id);
      if ($mhs) {
        $mhs->update($request->all()); 
        $success = [
          "message" => "Data Mahasantri Berhasil Diupdate",
          "data" => $mhs
        ];
        return response()->json($success, 200);
      } else {
        $fails = [
          "message" => "Data Mahasantri Tidak Ditemukan",
        ];
        return response()->json($fails, 404);
      }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DIGUNAKAN UNTUK MENGHAPUS DATA MAHASANTRI
        $mhs = Mahasantri::where('id', $id)->first();
        if (isset($mhs)) {
            $mhs->delete();
            $success = [
                'success' => true,
                'message' => 'Data Mahasantri Berhasil dihapus',
                'data' => $mhs
            ];
            return response()->json($success, 200);
        } else {
            $fails = [
                'success' => false,
                'message' => 'Data Mahasantri Tidak Ditemukan',
                'data' => []
            ];
            return response()->json($fails, 404);
        }
    }
}
