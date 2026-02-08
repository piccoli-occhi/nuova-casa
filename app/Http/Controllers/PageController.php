<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;
use Shweshi\OpenGraph\OpenGraph;

class PageController extends Controller
{
    public function store(StorePageRequest $request)
    {
        $data = (object) $request->validated();

        $tagId = $data->tag_id;
        $page = new Page();
        $page->favorite = false;
        $page->icon = $data->icon;
        $page->title = $data->title;
        $page->url = $data->url;
        $page->tag_id = $tagId;
        $page->user_id = auth()->user()->id;

        if (!preg_match('#^https?://#i', $page->url)) {
            $page->url = 'https://' . $page->url;
        }

        $page->save();

        return Redirect::to("/tags/$tagId");
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $data = (object) $request->validated();
        $tagId = $page->tag_id;
        $page->favorite = $data->favorite;

        $page->update();

        return Redirect::to("/tags/$tagId");
    }

    public function destroy(Page $page)
    {
        $parentId = $page->tag->id;
        Page::destroy($page->id);

        return Redirect::to("/tags/$parentId");
    }

    public function openGraph(FormRequest $request)
    {
        $data = $request->validate([
            'url' => ['required', 'string'],
        ]);
        Http::timeout(5)->get($data['url']);
        $graphResult = OpenGraph::fetch($data['url']);

        return response()->json($graphResult);
    }
}
