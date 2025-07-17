<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'ingredients' => $this->whenLoaded('ingredients', function () {
                return $this->ingredients->map(function ($ingredient) {
                    return $ingredient->formatted;
                });
            }, []),
            'steps' => $this->whenLoaded('steps', function () {
                return $this->steps->pluck('instruction');
            }, []),
            'author_email' => $this->author_email,
            'slug' => $this->slug,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
