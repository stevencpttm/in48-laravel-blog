<!doctype html>
<html>
<head>
    <title>@yield('title', 'Backend')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900">
    <header class="border-b bg-white">
        <div class="mx-auto flex max-w-5xl items-center justify-between px-4 py-4">
            <a href="/">Back to Home</a>
            <nav class="flex items-center gap-4 text-sm">
                @auth
                {{ Auth::user()->email }}
                @endauth

                <a href="/logout" class="text-gray-700 hover:text-gray-950">Logout</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8 flex gap-4">
        <nav class="flex flex-col gap-6 w-60 bg-slate-700 p-6 rounded text-white">
            <a href="{{ route('admin.posts.index') }}">Posts</a>
            <a href="{{ route('admin.tags.index') }}">Tags</a>
            <a href="{{ route('admin.categories.index') }}">Categories</a>
            <a href="{{ route('admin.users.index') }}">Users</a>
        </nav>
        
        <div class="flex-1 p-6 bg-white rounded">
            @yield('content')
        </div>
    </main>
</body>
</html>