<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];

     protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }
}
