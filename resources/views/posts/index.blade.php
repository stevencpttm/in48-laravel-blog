@extends('layouts.app')

@section('title', 'Home - Laravel Blog')

@section('content')
<div>
    <h1 class="text-2xl font-bold">Latest Posts</h1>
</div>

<div class="flex gap-6 mt-4">
    <div class="flex flex-col gap-6 flex-1">
        <div class="flex flex-col gap-4">
            @foreach ($posts as $post)
            <article class="rounded border bg-white p-5">
                <h2 class="text-xl font-bold mb-1">{{ $post->title }}</h2>
                @if ($post->category)
                <span class="inline-block px-2 py-0.5 bg-slate-200 text-slate-900 text-sm rounded-full">
                    {{ $post->category->name }}
                </span>
                @endif
                <p class="mt-3 text-gray-700">{{ $post->content }}</p>
                <a href="{{ route('posts.show', $post) }}" class="mt-4 inline-block text-sm text-blue-600">Read more</a>
            </article>
            @endforeach
        </div>
    </div>
    <aside class="w-44 shrink-0 rounded border bg-white p-4">
        <div class="flex flex-col gap-3">
            {{-- Categories --}}
            <div>
                <h2 class="font-semibold">Categories</h2>
                <div class="mt-3 flex flex-col gap-2 text-sm">
                    <a href="{{ route('posts.index') }}">All</a>
                    @foreach ($categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->id]) }}">
                        {{ $category->name }}
                        ({{ count($category->posts) }})
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Tags --}}
        </div>
    </aside>
</div>
@endsection