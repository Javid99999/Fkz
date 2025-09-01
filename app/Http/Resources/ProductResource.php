<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'] ?? $this->id,
            'name' => $this['name'] ?? $this->name,
            'cas_number' => $this['cas_number'] ?? $this->cas_number,
            'description' => $this['description'] ?? $this->description,
            'packaging' => $this['packaging'] ?? $this->packaging,
            'country' => new CountryResource($this->whenLoaded('country')),
            'classification' => ClassificationResource::collection($this->whenLoaded('productClassification')),
            'statements' => StatementResource::collection($this->whenLoaded('productStatements')),
            'property' => PropertyResource::collection($this->whenLoaded('productPropertyValues')),
            // 'image_vitrin_url' => $this->imageUrl('vitrin', 'vitrin-thumb'),
            'image_url'=> $this->imageUrls('detailfoto', 'detail'),
        ];
    }
}
