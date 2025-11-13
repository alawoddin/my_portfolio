<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Skill extends Model
{
    protected $guarded = [];

 // expose a computed attribute `photo_url`
    protected $appends = ['photo_url' , 'description'];

    public function getPhotoUrlAttribute(): string
{
    $photo = $this->photo ?? '';
    if ($photo === '') return '';

    if (preg_match('#^https?://#i', $photo)) return $photo;

    // if saved under storage/app/public
    if (strpos($photo, 'skill/') === 0) {
        return \Illuminate\Support\Facades\Storage::disk('public')->url($photo);
    }

    // if saved directly under /public (e.g., upload/brand/...)
    return asset($photo);
}

}
