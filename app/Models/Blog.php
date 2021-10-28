<?php

namespace app\Models;

use Illuminate\Support\Facades\File;

class Blog
{
    public static function all()
    {
        $files = File::files(resource_path("blogs"));
        return array_map(function ($file) {
            return $file->getContents();
        }, $files); //array_map ka $files htae ka mha $file ko htope pay tr. files amyr gyi htae ka 1 khu si pyan pya pay tr
    }
    public static function find($slug)
    {
        // $path = __DIR__."/../resources/blogs/$slug.html";
        $path = resource_path("blogs/$slug.html");
        if (!file_exists($path)) {
            return redirect('/');
        }
        return cache()->remember("posts.$slug", now()->addMinute(), function () use ($path) {

            return file_get_contents($path);
        });
    }
}
