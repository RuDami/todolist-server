<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use UsesUuid;
    protected $guarded = [];
    protected $fillable = ['title', 'status', 'priority'];
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
