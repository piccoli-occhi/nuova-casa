<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AppController extends Controller
{
    public function dashboard () {
        $pages = auth()->user()->pages;

        return Inertia::render('Dashboard', array(
            "pages" => $pages,
        ));
    }
}
