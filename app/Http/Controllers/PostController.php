<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $selectedCategory = $request->query('category');
        $selectedTag = $request->query('tag');

        $posts = Post::where('is_published', true)
                     ->when($selectedCategory, function ($query, $categoryId) {
                        $query->where('category_id', $categoryId);
                     })
                     ->when($selectedTag, function ($query, $tagId) {
                        $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                            $tagQuery->where('tags.id', $tagId);
                        });
                     })
                     ->latest()
                     ->get();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'selectedCategory' => $selectedCategory,
            'selectedTag' => $selectedTag,
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}