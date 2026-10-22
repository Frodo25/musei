<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExhibitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'author'      => $this->author,
            'year'        => $this->year,
            'description' => $this->description,
            'cover'       => $this->cover_url ?? null, // Аксессор из ЛР8
            'hall'        => new HallResource($this->whenLoaded('hall')),
            'created_at'  => $this->created_at?->toIso8601String(),
            'links'       => [
                'self' => route('api.v1.exhibits.show', $this->id)
            ],
        ];
    }
}