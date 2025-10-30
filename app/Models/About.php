<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    protected $guarded = [];

    // Make both accessors available on arrays/JSON
    protected $appends = ['photo_url', 'information_short'];

    /**
     * Full photo URL (falls back to a placeholder if file missing)
     */
    public function getPhotoUrlAttribute(): string
    {
        $path = $this->photo; // e.g. "upload/about/abc.jpg" relative to /public

        if ($path && file_exists(public_path($path))) {
            return asset($path);
        }

        return asset('images/no_image.png');
    }

    /**
     * Truncated information for table display
     */
    public function getInformationShortAttribute(): string
    {
        return Str::limit((string) ($this->information ?? ''), 80, '...');
    }
}
