<?php

namespace App\Http\Resources;

use DateTime;
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
        $published_at = new DateTime($this->published_at);
        $published_at = $published_at->format('d M, Y');

        return [
            'uuid' => $this->uuid,
            'title' => $this->title,
            'user' => UserResource::make($this->whenLoaded('user')),
            'body' => $this->body,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'published' => $this->isPublished(),
            'published_at' => $published_at,
         ];
    }
}
