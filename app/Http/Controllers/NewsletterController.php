<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterRequest;
use App\Models\Newsletter;
use Inertia\Inertia;
use Vedmant\FeedReader\Facades\FeedReader;

class NewsletterController extends Controller
{
    private function getNewsletters()
    {
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('newsletter/NewsletterList', array(
            'news' => Inertia::optional(
                function () {
                    return $this->getNewsletters();
                }
            )
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsletterRequest $request)
    {
        try {
            $url = $request->input('url');
            $f = FeedReader::read($url);

            if ($f->error()) {
                return back()->withErrors(['url' => $f->error()]);
            }

            $news = new Newsletter();
            $news->url = $url;
            $news->title = $f->get_title();
            $news->user_id = auth()->user()->id;

            $news->save();

            return Inertia::render('newsletter/NewsletterList', [
                'news' => $this->getNewsletters(),
            ]);
        } catch (\Exception $e) {
            return Inertia::render('newsletter/NewsletterList', [
                'news' => Inertia::optional(
                    function () {
                        return $this->getNewsletters();
                    }
                ),
                'errors' => ['url' => $e->getMessage()]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Newsletter $newsletter)
    {
        //
    }
}
