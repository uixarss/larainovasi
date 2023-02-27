<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::with(['parent', 'post'])->orderBy('created_at', 'DESC')->get();
        $parent = Category::getParent()->with(['child'])->orderBy('name', 'ASC')->get();
        return view('super.categories.index', [
            'categories' => $category,
            'parent' => $parent
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:categories'
        ]);

        $request->request->add(['slug' => \Str::slug($request->name)]);
        Category::create($request->except('_token'));

        return redirect()->back()->with(['success' => 'Kategori Baru Ditambahkan!']);
    }
    public function edit(Category $category)
    {
        $categories = Category::with(['parent'])->orderBy('created_at', 'DESC')->get();
        $parent = Category::getParent()->with(['child'])->orderBy('name', 'ASC')->get();
        return view('super.categories.edit', [
            'categories' => $categories,
            'category' => $category,
            'parent' => $parent
        ]);
    }
    public function update(Category $category)
    {
        // dd(request());
        request()->validate([
            'name' => 'required|string'
        ]);
        $category->update([
            'name' => request()->name,
            'parent_id' => request()->parent_id
        ]);
        return redirect()->back()->with(['success' => 'Kategori berhasil diedit!']);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.list.category')->with(['success' => 'Kategori berhasil dihapus!']);
    }
    public function getPostCategory($id)
    {
        if (request()->ajax()) {
            $post = Post::where('id', $id)->first();
            $category = $post->category()->get();
            return response()->json($category, 200);
        }
    }
}
