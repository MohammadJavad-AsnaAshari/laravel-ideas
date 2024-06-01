<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
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

    public function store(IdeaRequest $request)
    {
        $validated = [
            'content' => $request->validated('content'),
            'user_id' => auth()->id()
        ];

        Idea::create($validated);

        return redirect()->route('ideas.index')->with('success', 'Idea created successfully !');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);
        $editing = true;

        return view('ideas.show',compact('idea','editing'));
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        $this->authorize('udpate', $idea);
        $idea->update($request->validated());

        return redirect()->route('ideas.show', ['idea' => $idea])->with('success', 'Idea updated successfully !');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);
        $idea->delete();

        return redirect()->route('ideas.index')->with('success', 'Idea deleted successfully !');
    }
}
