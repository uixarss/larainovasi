<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')->with(['category'])->latest()->simplePaginate(8);
        $categories = Category::all();
        return view('blog', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;

        $posts = Post::where('status', 'published')->where('title', 'like', "%" . $cari . "%")->with(['category'])->latest()->simplePaginate(8);
        $categories = Category::all();
        // mengirim data pegawai ke view index
        return view('blog', ['posts' => $posts, 'categories' => $categories]);
    }

    public function showByCategory(Category $category)
    {
        $posts = $category->post()->where('status', 'published')->latest()->simplePaginate(8);
        $categories = Category::all();
        return view('blog', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->with(['category'])->first();
        if ($post !== null) {
            $post->update([
                'read' => $post->read++
            ]);
            return view('detailblog', compact('post'));
        } else {
            return redirect()->back()->with('error', 'Post tidak tersedia!');
        }
    }
}
