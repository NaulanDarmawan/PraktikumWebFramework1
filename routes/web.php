<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PageController::class, 'index']);

Route::get('/hello', [App\Http\Controllers\WelcomeController::class, 'hello']);

Route::get('/world', function () {
    return "World";
});

Route::get('/about', [App\Http\Controllers\AboutController::class, 'about']);

// Route::get('/user/{name}', function ($name) {
//     return "Nama saya $name";
// });

Route::get('/user/{name?}', function ($name="John") {
        return "Nama saya $name";
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return "Pos ke-$postId Komentar ke-$commentId";
});

Route::get('/articles/{id}', [App\Http\Controllers\ArticleController::class, 'articles']);
