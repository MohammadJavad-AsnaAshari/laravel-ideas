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

        return redirect()->route('idea.index')->with('success', 'Idea created successfully !');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        if (auth()->id() !== $idea->user->id){
            abort(401, "User can't perform this actions");
        }
        $editing = true;

        return view('ideas.show',compact('idea','editing'));
    }

    public function update(IdeaRequest $request, Idea $idea)
    {
        if (auth()->id() !== $idea->user->id){
            abort(401, "User can't perform this actions");
        }
        $idea->update($request->validated());

        return redirect()->route('idea.show', ['idea' => $idea])->with('success', 'Idea updated successfully !');
    }

    public function destroy(Idea $idea)
    {
        if (auth()->id() !== $idea->user->id){
            abort(401, "User can't perform this actions");
        }
        $idea->delete();

        return redirect()->route('idea.index')->with('success', 'Idea deleted successfully !');
    }
}
