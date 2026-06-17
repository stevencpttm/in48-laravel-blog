<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'content' => ['required'],
        ]);

        $post->comments()->create($data);

        // $comment = new Comment;
        // $comment->post_id = $post->id;
        // $comment->name = $data['name'];

        return redirect()->route('posts.show', $post);
    }
}
