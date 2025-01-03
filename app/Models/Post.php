<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'content', 'image'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Generate a unique slug for the note.
     *
     * @return void
     */
    protected function generateSlug()
    {
        $slug = Str::slug($this->title);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();
        $this->slug = $count ? "{$slug}-{$count}" : $slug;
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            $post->generateSlug();

            if (request()->hasFile('image')) {
                if ($post->getOriginal('image')) {
                    Storage::disk('public')->delete($post->getOriginal('image'));
                }
            }
        });

        static::deleting(function ($post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // // Loop through each image and delete it
            // foreach ($post->images as $image) {
            //     Storage::disk('public')->delete($image->path);
            //     $image->delete();
            // }
        });
    }
}
