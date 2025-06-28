<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $hidden = array("user_id", "tag", "tag_id");

    protected $appends = ['parent'];

    public function getParentAttribute()
    {
        return array(
            'id' => $this->tag->id,
            'name' => $this->tag->name,
            'color' => $this->tag->color,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
