<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author_email' => $this->author_email,
            'slug' => $this->slug,
            'ingredients_count' => $this->whenLoaded('ingredients', function () {
                return $this->ingredients->count();
            }, 0),
            'steps_count' => $this->whenLoaded('steps', function () {
                return $this->steps->count();
            }, 0),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
