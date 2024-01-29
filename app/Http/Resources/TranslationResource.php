<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->value['name'] ?? '',
            'excerpt' => $this->value['excerpt'] ?? '',
            'description' => $this->value['description'] ?? '',
            'slug' => route($this->lang . '.services.slug', ['locale' => $this->lang, 'slug' => $this->value['slug'] ?? '']),
            'lang' => $this->lang,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
