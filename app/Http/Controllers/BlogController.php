<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $category_widgat = Category::all();

        $posts = Post::orderBy('created_at', 'DESC')->take(5)->get();
        return view('frontend.content', compact('posts', 'category_widgat'));
    }

    public function isi_blog($slug)
    {
        $category_widgat = Category::all();

        $data = Post::where('slug', $slug)->get();
        return view('blog.isi_posts', compact('data', 'category_widgat'));
    }

    public function listBlog()
    {
        $category_widgat = Category::all();

        $data = Post::latest()->paginate(5);
        return view('blog.list', compact('data', 'category_widgat'));
    }

    public function listCategory(Category $category)
    {

        $category_widgat = Category::all();

        $data = $category->posts()->paginate(5);
        return view('blog.list', compact('data', 'category_widgat'));
    }

    public function cari(Request $request)
    {
        $category_widgat = Category::all();

        $data = Post::where('title', 'like', '%' . $request->cari . '%')->paginate(5);
        return view('blog.list', compact('data', 'category_widgat'));
    }
}
