<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['category'])->get();
        $postPublished = Post::where('status', 'published')->count();
        $postDraft = Post::where('status', 'draft')->count();
        return view('super.posts.index', ['posts' => $posts, 'published' => $postPublished, 'draft' => $postDraft]);
    }

    public function create()
    {
        $categories = Category::with(['parent'])->orderBy('created_at', 'ASC')->get();
        return view('super.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = Auth::id();
        $this->validate($request, [
            'title' => 'required|unique:posts',
            'content' => 'required',
            'categories' => 'required',
            'status' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,png|max:1024',
        ]);

        try {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = 'blog_' . time() . '.' . $extension;
                $file->move('blog/images/', $filename);
            }
            if ($request->status == "published") {
                $request->request->add(['publish_date' => now()]);
            } else {
                $request->request->add(['publish_date' => null]);
            }
            $post = Post::create([
                'author_id' => $user,
                'slug' => \Str::slug($request->title),
                'title' => $request->title,
                'excerpt' => null,
                'content' => $request->content,
                'status' => $request->status,
                'publish_date' => $request->publish_date,
                'thumbnail' => $filename,
                'meta' => 'null',
            ]);

            if ($post) {
                $post->category()->attach($request->categories);
            }
            return redirect()->back()->with(['success' => "Berhasil tambah post"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $post = Post::where('id', $id)->with('category')->first();
        $categories = Category::with(['parent'])->orderBy('created_at', 'ASC')->get();
        return view('super.posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
    public function update($id, Request $request)
    {
        $post = Post::where('id', $id)->with('category')->first();
        if ($post->status !== 'published') {
            if ($request->status == 'draft' || $request->status == 'pending') {
                $request->request->add(['publish_date' => null]);
            } else {
                $request->request->add(['publish_date' => now()]);
            }
        } else {
            $request->request->add(['publish_date' => $post->publish_date]);
        }
        $user = Auth::id();
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'categories' => 'required',
            'status' => 'required',
            'thumbnail' => 'image|mimes:jpg,png|max:1024',
        ]);

        try {
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $extension = $file->getClientOriginalExtension();
                $filename = 'blog_' . time() . '.' . $extension;
                if (File::exists('blog/images/' . $post->thumbnail)) {
                    $file->move('blog/images/', $filename);
                    File::delete('blog/images/' . $post->thumbnail);
                }
                $post->update([
                    'author_id' => $user,
                    'slug' => \Str::slug($request->title),
                    'title' => $request->title,
                    'excerpt' => null,
                    'content' => $request->content,
                    'status' => $request->status,
                    'publish_date' => $request->publish_date,
                    'thumbnail' => $filename,
                    'meta' => 'null',
                ]);
            } else {
                $post->update([
                    'author_id' => $user,
                    'slug' => \Str::slug($request->title),
                    'title' => $request->title,
                    'excerpt' => null,
                    'content' => $request->content,
                    'status' => $request->status,
                    'publish_date' => $request->publish_date,
                    'meta' => 'null',
                ]);
            }
            if ($post) {
                $post->category()->sync(request('categories')); //sync tag ke db

            }
            return redirect()->back()->with(['success' => "Berhasil update post"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        $post = Post::find($id);

        if (File::exists('blog/images/' . $post->thumbnail)) {
            File::delete('blog/images/' . $post->thumbnail);
        }

        $post->delete($post);

        return redirect()->back()->with(['success' => "Berhasil hapus data"]);
    }
}
