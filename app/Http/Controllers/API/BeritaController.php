<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(5);
        return new ResponseResource(true,'list data kontak', $berita);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'id_admin' => 'required',
            'id_daerah' => 'required',
            'id_kategori' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $berita = Berita::create([
            'judul' => $request-> judul,
            'deskripsi' => $request-> deskripsi,
            'tanggal' => $request-> tanggal,
            'id_admin' => $request-> id_admin,
            'id_daerah' => $request-> id_daerah,
            'id_kategori' => $request-> id_kategori
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $berita);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $berita);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $berita = Berita::whereId($request->input('id'))->update([
                'judul' => $request-> input('judul'),
                'deskripsi' => $request-> input('deskripsi'),
                'tanggal' => $request-> input('tanggal'),
            ]);

            if ($berita) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $berita);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
