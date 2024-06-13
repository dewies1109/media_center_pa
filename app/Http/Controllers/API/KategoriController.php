<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->paginate(5);
        return new ResponseResource(true,'list data kategori', $kategori);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori = Kategori::create([
            'nama' => $request-> nama
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kategori);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = Kategori::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kategori);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $kategori = Kategori::whereId($request->input('id'))->update([
                'nama' => $request-> input('nama')
            ]);

            if ($kategori) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kategori);
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
