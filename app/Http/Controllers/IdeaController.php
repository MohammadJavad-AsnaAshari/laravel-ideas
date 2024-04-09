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
        Idea::create($request->validated());

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

    public function update(IdeaRequest $request, Idea $idea)
    {
        $idea->update($request->validated());

        return redirect()->route('idea.show', ['idea' => $idea])->with('success', 'Idea updated successfully !');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();

        return redirect()->route('idea.index')->with('success', 'Idea deleted successfully !');
    }
}
