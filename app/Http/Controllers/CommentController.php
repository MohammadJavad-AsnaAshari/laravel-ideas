<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea)
    {
        $validate = request()->validate([
            'content' => 'required|min:5|max:255'
        ]);

        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->content = $validate['content'];
        $comment->save();

        return redirect()->route('idea.show', $idea->id)->with('success', 'Comment posted successfully!');
    }
}
