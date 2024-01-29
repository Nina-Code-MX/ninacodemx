<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cookie;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $service = [
            'id' => $this->id,
            'name' => $this->name,
            'excerpt' => $this->excerpt,
            'description' => $this->excerpt,
            'slug' => route(app()->getLocale() . '.services.slug', ['locale' => app()->getLocale(), 'slug' => $this->slug]),
            'lang' => app()->getLocale()
        ];

        if (
            ($request->has('getTranslations') && $request->get('getTranslations') == 'true')
            ||
            !$request->has('lang')
        ) {
            $service['translations'] = TranslationResource::collection($this->whenLoaded('translations'));
        }

        return $service;
    }
}
