<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard', [
            'ideas' => Idea::orderBy('created_at','DESC')->paginate(5)
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:5|max:255'
        ]);

        Idea::create([
            'content' => request()->get('content', '')
        ]);

        return redirect()->route('idea.index')->with('success', 'Idea created successfully !');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        $editing = true;

        return view('ideas.show',compact('idea','editing'));
    }

    public function update(Request $request, Idea $idea)
    {
        $request->validate([
            'content' => 'required|min:5|max:255'
        ]);

        $idea->update([
            'content' => request()->get('content', '')
        ]);

        return redirect()->route('idea.show', ['idea' => $idea])->with('success', 'Idea updated successfully !');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('index')->with('success', 'Idea deleted successfully !');
    }
}
