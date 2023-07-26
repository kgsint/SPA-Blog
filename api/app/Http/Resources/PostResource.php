<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'user' => UserResource::make($this->whenLoaded('user')),
            'body' => $this->body,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'published' => $this->published,
            'published_at' => DatetimeResource::make($this->updated_at),
         ];
    }
}
