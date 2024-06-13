<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Daerah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class DaerahController extends Controller
{
    public function index()
    {
        $daerah = Daerah::latest()->paginate(5);
        return new ResponseResource(true,'list data daerah', $daerah);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $daerah = Daerah::create([
            'nama' => $request-> nama
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $daerah);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $daerah = Daerah::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $daerah);

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
            $daerah = Daerah::whereId($request->input('id'))->update([
                'nama' => $request-> input('nama')
            ]);

            if ($daerah) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $daerah);
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
