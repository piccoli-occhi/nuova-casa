<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = array("user_id", "pages");

    protected $appends = ['children'];

    public function getChildrenAttribute()
    {
        return $this->pages->map(function ($map) {
            return array(
                "id" => $map->id,
                "readCount" => $map->readCount,
                "title" => $map->title,
                "icon" => $map->icon,
                "favorite" => $map->favorite,
            );
        });
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
