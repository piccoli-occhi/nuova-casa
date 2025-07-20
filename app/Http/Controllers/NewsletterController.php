<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Vedmant\FeedReader\Facades\FeedReader;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('newsletter/NewsletterList', array(
            'news' => Inertia::optional(
                function () {
                    return Newsletter
                        ::where('user_id', auth()->user()->id)
                        ->get()
                        ->map(function ($map) {
                            return array(
                                'title' => $map->title,
                                'url' => $map->url,
                                'lastLink' => $map->getLastLink(),
                            );
                        });
                }
            )
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsletterRequest $request)
    {
        $url = $request->input('url');
        $f = FeedReader::read($url);
        $news = new Newsletter();
        $news->url = $url;
        $news->title = $f->get_title();
        $news->user_id = auth()->user()->id;

        $news->save();

        return Redirect::to("/newsletters");

        // return response()->json(array(
        //     "title" => $f->get_title(),
        //     "last" => $f->get_items()[0]->get_title(),
        // ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
