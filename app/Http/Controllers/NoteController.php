<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

    public function index()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Auth::user()->notes()->create($request->only('title', 'content'));

        return redirect('/')->with('success', 'Note added!');
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $note->update($request->only('title', 'content'));

        return redirect('/')->with('success', 'Note updated!');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/')->with('success', 'Note deleted!');
    }
}
