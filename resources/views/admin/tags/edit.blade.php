@extends('layouts.admin')

@section('title', 'Edit Tag - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Edit Tag</h1>
    <a href="{{ route('admin.tags.index') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Back</a>
  </div>

  <form method="POST" action="{{ route('admin.tags.update', $tag) }}" class="flex flex-col gap-4 rounded border bg-gray-100 p-5">
    @method('PUT')
    @csrf

    <div>
      <label class="text-sm font-medium" for="name">Title</label>
      <input id="name" name="name" value="{{ old('name', $tag->name) }}" class="mt-1 w-full rounded border px-3 py-2">
      @error('name')
      <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <button class="rounded bg-gray-900 px-4 py-2 text-white">Save</button>
  </form>
</section>
@endsection