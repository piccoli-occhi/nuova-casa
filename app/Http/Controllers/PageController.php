<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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
        $oage = new Page();
        $oage->favorite = false;
        $oage->icon = $data->icon;
        $oage->title = $data->title;
        $oage->url = $data->url;
        $oage->readCount = 0;
        $oage->tag_id = $tagId;
        $oage->user_id = auth()->user()->id;

        $oage->save();

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

    public function read(Page $page)
    {
        $page->readCount += 1;
        $page->save();

        return Redirect::to($page->url);
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
