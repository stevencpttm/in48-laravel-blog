@extends('layouts.admin')

@section('title', 'Manage Posts - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Posts</h1>
    <a href="{{ route('admin.posts.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Create Post</a>
  </div>

  <div class="rounded border bg-white">
    @forelse ($posts as $post)
    <div class="flex items-center justify-between border-b p-4 last:border-b-0">
      <div>
        <h2 class="font-semibold">{{ $post->title }}</h2>
        <div class="flex gap-2 items-center">
          <p class="text-sm text-gray-500">
            {{ $post->is_published ? 'Published' : 'Draft' }}
          </p>
          @if ($post->category)
          <h4 class="text-gray-900 bg-gray-200 px-1 py-0.5 rounded inline-block text-sm">
            {{ $post->category->name }}
          </h4>
          @endif

          @if ($post->tags)
            @foreach ($post->tags as $tag)
            <span class="text-sm inline-block rounded px-1 py-0.5 bg-blue-100 text-blue-800">
              {{ $tag->name }}
            </span>
            @endforeach
          @endif
        </div>
      </div>
      <div class="flex items-center gap-3 text-sm">
        <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600">Edit</a>

        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onSubmit="return confirm('Are you sure to delete this?')">
          @csrf
          @method('DELETE')
          <button class="text-red-600">Delete</button>
        </form>
      </div>
    </div>
    @empty
    <div class="p-4 text-gray-600">No posts.</div>
    @endforelse
  </div>
</section>
@endsection