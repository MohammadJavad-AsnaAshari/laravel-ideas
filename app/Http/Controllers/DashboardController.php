<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('dashboard.dashboard', [
            'ideas' => Idea::orderBy('created_at','DESC')->paginate(5)
        ]);
    }
}
