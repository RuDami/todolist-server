<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use UsesUuid;
    protected $guarded = [];
    protected $fillable = ['title'];
    public function tasks()
    {
        return $this->morphedByMany('App\Task', 'taggable');
    }
}
