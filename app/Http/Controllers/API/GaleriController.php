<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(5);
        return new ResponseResource(true,'list data galeri', $galeri);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal' => 'required',
            'id_admin' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $galeri = Galeri::create([
            'judul' => $request-> judul,
            'tanggal' => $request-> tanggal,
            'id_admin' => $request-> id_admin
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $galeri);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $galeri = Galeri::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $galeri);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $galeri = Galeri::whereId($request->input('id'))->update([
                'judul' => $request-> input('judul'),
                'tanggal' => $request-> input('tanggal'),
            ]);

            if ($galeri) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $galeri);
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
