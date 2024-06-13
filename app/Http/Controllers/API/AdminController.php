<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::latest()->paginate(5);
        return new ResponseResource(true,'list data admin', $admin);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::create([
            'nama' => $request-> nama,
            'username' => $request-> username,
            'password' => $request-> password
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $admin);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Admin::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $admin);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $admin = Admin::whereId($request->input('id'))->update([
                'nama' => $request-> input('nama'),
                'username' => $request-> input('username'),
                'password' => $request-> input('password')
            ]);

            if ($admin) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $admin);
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
