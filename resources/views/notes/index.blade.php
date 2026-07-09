@extends('layouts.app')

@section('content')
    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <p class="font-semibold">Please fix the following:</p>
            <ul class="list-disc list-inside text-sm mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Note Form --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Add a Note</h2>
        <form action="/notes" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Title</label>
                <input type="text" name="title"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Note title">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Content</label>
                <textarea name="content" rows="4"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Write your note..."></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                Save Note
            </button>
        </form>
    </div>

    {{-- Notes List --}}
    <h2 class="text-xl font-semibold text-gray-700 mb-4">My Notes</h2>
    @forelse($notes as $note)
        <div class="bg-white rounded-lg shadow p-4 mb-3 flex justify-between items-start">
            <div>
                <h3 class="text-lg font-bold text-gray-800">{{ $note->title }}</h3>
                <p class="text-gray-600 mt-1">{{ $note->content }}</p>
                <span class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex gap-2 ml-4">
                <a href="/notes/{{ $note->id }}/edit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                    Edit
                </a>
                <form action="/notes/{{ $note->id }}" method="POST" onsubmit="return confirm('Delete this note?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No notes yet. Add one above!</p>
    @endforelse
@endsection
