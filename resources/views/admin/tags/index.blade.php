@extends('layouts.admin')

@section('title', 'Manage Tags - Backend')

@section('content')
<section class="flex flex-1 flex-col gap-4">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-bold">Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Create Tag</a>
  </div>

  <div class="rounded border bg-white">
    @forelse ($tags as $tag)
    <div class="flex items-center justify-between border-b p-4 last:border-b-0">
      <div>
        <h2 class="font-semibold">{{ $tag->name }}</h2>
      </div>
      <div class="flex items-center gap-3 text-sm">
        <a href="{{ route('admin.tags.edit', $tag) }}" class="text-blue-600">Edit</a>

        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}" onSubmit="return confirm('Are you sure to delete this?')">
          @csrf
          @method('DELETE')
          <button class="text-red-600">Delete</button>
        </form>
      </div>
    </div>
    @empty
    <div class="p-4 text-gray-600">No tags.</div>
    @endforelse
  </div>
</section>
@endsection