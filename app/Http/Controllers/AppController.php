<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Inertia\Inertia;

class AppController extends Controller
{
    public function dashboard () {
        $pages = Page::where('user_id', auth()->user()->id)
            ->where('favorite', true)
            ->orderBy('created_at', 'asc')
            ->get();

        return Inertia::render('Dashboard', array(
            "pages" => $pages,
        ));
    }
}
