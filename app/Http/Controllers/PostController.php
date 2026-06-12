<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $categories = Category::orderBy('name')->get();
        $selectedCategory = $request->query('category');

        $posts = Post::where('is_published', true)
                     ->when($selectedCategory, function ($query, $categoryId) {
                        $query->where('category_id', $categoryId);
                     })
                     ->latest()
                     ->get();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}