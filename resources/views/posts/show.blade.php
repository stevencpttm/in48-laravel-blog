@extends('layouts.app')

@section('title', $post->title . ' - Laravel Blog')

@section('content')
<div class="flex flex-col gap-6">
    <a href="{{ route('posts.index') }}">Back to Home</a>

    <article class="rounded border bg-white p-6">
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <p class="text-gray-500 text-sm mt-2">{{ $post->created_at->format('Y-m-d H:i') }}</p>
        <div class="mt-6 text-gray-800">{!! nl2br($post->content) !!}</div>
    </article>

    <section class="flex flex-col gap-3">
        @forelse ($post->comments as $comment)
        <div class="rounded border bg-white p-4">
            <div clsas="flex items-center justify-between text-sm">
                <strong>{{ $comment->name }}</strong>
                <span class="text-gray-500">{{ $comment->created_at->format('Y-m-d H:i') }}</span>
            </div>
            <p clsas="mt-3 whitespace-pre-line text-gray-700">{{ $comment->content }}</p>
        </div>
        @empty
        <div clsas="rounded border bg-white p-4 text-gray-600">No comments.</div>
        @endforelse
    </section>

    <section class="rounded border bg-white p-6">
        <h2 class="text-xl font-bold">Comments</h2>

        <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-4 flex flex-col gap-3">
            @csrf

            <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="rounded border px-3 py-2">
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="rounded border px-3 py-2">
            <textarea name="content" rows="4" placeholder="Content" class="rounded border px-3 py-2">{{ old('content') }}</textarea>
            <button class="rounded bg-gray-900 px-4 py-2 text-white">Submit Comment</button>
        </form>
    </section>
</div>
@endsection