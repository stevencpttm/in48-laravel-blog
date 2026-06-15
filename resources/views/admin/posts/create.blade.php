@extends('layouts.admin')

@section('title', 'Create Post - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Create Post</h1>
    <a href="{{ route('admin.posts.index') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Back</a>
  </div>

  <form method="POST" action="{{ route('admin.posts.store') }}" class="flex flex-col gap-4 rounded border bg-gray-100 p-5">
    @csrf

    <div>
      <label class="text-sm font-medium" for="title">Title</label>
      <input id="title" name="title" value="{{ old('title') }}" class="mt-1 w-full rounded border px-3 py-2">
      @error('title')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="text-sm font-medium" for="category_id">Category</label>
      <select id="category_id" name="category_id" class="mt-1 w-full rounded border px-3 py-2">
        <option value="">N/A</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
        @endforeach
      </select>
      @error('category_id')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label class="text-sm font-medium" for="category_id">Tags</label>
      <div class="mt-2 flex flex-wrap gap-3">
        @foreach ($tags as $tag)
        <label class="flex items-center gap-2 text-sm">
          <input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tag_ids', [])))>
          {{ $tag->name }}
        </label>
        @endforeach
      </div>
    </div>

    <div>
      <label class="text-sm font-medium" for="content">Content</label>
      <textarea id="content" name="content" class="mt-1 w-full rounded border px-3 py-2">{{ old('content') }}</textarea>
      @error('content')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <label class="text-sm font-medium">
      <input type="checkbox" name="is_published" value="1">
      Is Publish
    </label>

    <button class="rounded bg-gray-900 px-4 py-2 text-white">Save</button>
  </form>
</section>
@endsection