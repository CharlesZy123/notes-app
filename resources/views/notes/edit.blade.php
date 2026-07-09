@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-xl mx-auto">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Edit Note</h2>
        <form action="/notes/{{ $note->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $note->title) }}"
                    class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Content</label>
                <textarea name="content" rows="4"
                    class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-400">{{ old('content', $note->content) }}</textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                    Update Note
                </button>
                <a href="/" class="text-gray-500 hover:underline py-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
