<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
        
        return Inertia::render('tags/TagList', array(
            "tags" => $tags,
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $data = (object) $request->validated();

        $tag = new Tag();
        $tag->icon = $data->icon;
        $tag->name = $data->name;
        $tag->color = $data->color;
        $tag->user_id = auth()->user()->id;

        $tag->save();

        return Redirect::to("/tags");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return Inertia::render('tags/TagDetails', array(
            "tag" => $tag,
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
