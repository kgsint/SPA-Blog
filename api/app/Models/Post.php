<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    // generate uuid and slug when create a post
    public static function booted()
    {
        static::creating(function(Post $post) {
            $post->uuid = Str::uuid();

            if(!$post->slug) {
                $post->slug = $post->uuid;
            }
        });
    }

    // eloquent relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
