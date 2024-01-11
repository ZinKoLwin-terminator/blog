<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('blogs');
});

Route::get('/blogs/{blog}', function ($slug) {
    $path = __DIR__ . "/../resources/blogs/$slug.html";
    if (!file_exists($path)) {
        return redirect('/'); //dd,abort,redirect
    }
    $blog = cache()->remember("posts.$slug", 120, function () use ($path) {
        var_dump('file get contents');
        return file_get_contents($path);
    });
    return view('blog', [
        'blog' => $blog
    ]);
})->where('blog', '[A-z\d\-_]+');
