<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $commentRequest, Idea $idea)
    {
        $validated = $commentRequest->validated();

        $idea->comments()->create([
            'content' => $validated['comment-content']
        ]);

        return redirect()->route('idea.show', $idea->id)->with('success', 'Comment posted successfully!');
    }
}
