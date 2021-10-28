<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Blogs');
});

// Route::get('/blog',function(){
//     $blog=file_get_contents(__DIR__.'/../resources/blogs/first-blog.html');
//     return view('Blog',[
//         'blog'=>$blog
//     ]);
// });

Route::get('/blogs/{blog}', function ($slug) {

    $path = __DIR__."/../resources/blogs/$slug.html";
    if(!file_exists($path)){
        return redirect('/');
    }
    $blog = cache()->remember("posts.$slug",now()->addMinute(),function() use ($path){
        var_dump('file_get-contents');
        return file_get_contents($path);
    });


    return view('Blog',[
        'blog' => $blog
    ]);
})->where('blog','[A-z\d\-_]+');