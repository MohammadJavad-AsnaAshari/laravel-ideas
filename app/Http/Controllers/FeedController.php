<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $followingIDs = $user->followings()->pluck('id');

        $ideas = Idea::whereIN('user_id', $followingIDs)->latest();

        if (request()->has('search')) {
            $ideas->search(request('search', ''));
        }

        return view('dashboard.dashboard', [
            'ideas' => $ideas->paginate(5)
        ]);
    }
}
