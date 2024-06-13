<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\DaerahController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\GaleriController;
use App\Http\Controllers\API\BeritaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('berita/store', [BeritaController::class, 'store']);
Route::get('berita/index', [BeritaController::class, 'index']);
Route::get('berita/{id}', [BeritaController::class, 'show']);
Route::post('berita/update', [BeritaController::class, 'update']);

Route::post('galeri/store', [GaleriController::class, 'store']);
Route::get('galeri/index', [GaleriController::class, 'index']);
Route::get('galeri/{id}', [GaleriController::class, 'show']);
Route::post('galeri/update', [GaleriController::class, 'update']);

Route::post('kategori/store', [KategoriController::class, 'store']);
Route::get('kategori/index', [KategoriController::class, 'index']);
Route::get('kategori/{id}', [KategoriController::class, 'show']);
Route::post('kategori/update', [KategoriController::class, 'update']);

Route::post('daerah/store', [DaerahController::class, 'store']);
Route::get('daerah/index', [DaerahController::class, 'index']);
Route::get('daerah/{id}', [DaerahController::class, 'show']);
Route::post('daerah/update', [DaerahController::class, 'update']);

Route::post('admin/store', [AdminController::class, 'store']);
Route::get('admin/index', [AdminController::class, 'index']);
Route::get('admin/{id}', [AdminController::class, 'show']);
Route::post('admin/update', [AdminController::class, 'update']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
