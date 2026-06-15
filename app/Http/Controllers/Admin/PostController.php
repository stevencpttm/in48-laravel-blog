<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'content' => ['required'],
            'tag_ids' => ['array'],
            'tag_ids.*' => ['exists:tags,id'],
        ]);

        $tagIds = $data['tag_ids'] ?? [];
        unset($data['tag_ids']);

        $data['is_published'] = $request->has('is_published');

        $post = new Post();
        $post->title = $data['title'];
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->is_published = $data['is_published'];
        $post->save();

        // update relation
        // 1. delete all records in post_tag table where post_id = $post->id
        // 2. create relation of $post->id <> $tagIds
        $post->tags()->sync($tagIds);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.posts.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'content' => ['required'],
            'tag_ids' => ['array'],
            'tag_ids.*' => ['exists:tags,id'],
        ]);

        $tagIds = $data['tag_ids'] ?? [];
        unset($data['tag_ids']);

        $data['is_published'] = $request->has('is_published');

        $post->title = $data['title'];
        $post->category_id = $data['category_id'];
        $post->content = $data['content'];
        $post->is_published = $data['is_published'];
        $post->save();

        $post->tags()->sync($tagIds);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
