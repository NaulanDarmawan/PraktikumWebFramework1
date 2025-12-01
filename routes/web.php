<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;

// --- ROUTE LATIHAN ROUTING ---
// Route::get('/', [App\Http\Controllers\PageController::class, 'index']);

// Route::get('/hello', [App\Http\Controllers\WelcomeController::class, 'hello']);

// Route::get('/world', function () {
//     return "World";
// });

// Route::get('/about', [App\Http\Controllers\AboutController::class, 'about']);

// Route::get('/user/{name}', function ($name) {
//     return "Nama saya $name";
// });

// Route::get('/user/{name?}', function ($name="John") {
//        return "Nama saya $name";
// });

// Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
//     return "Pos ke-$postId Komentar ke-$commentId";
// });

// Route::get('/articles/{id}', [App\Http\Controllers\ArticleController::class, 'articles']);
// --- BATAS ROUTE LATIHAN ROUTING ---

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

// --- HASIL PRAKTIKUM 2.6 (CREATE, READ, UPDATE, DELETE) ---
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
