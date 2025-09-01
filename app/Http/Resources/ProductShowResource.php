<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShowResource extends JsonResource
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
            'name' => $this->name,
            'cas_num' => $this->cas_number,
            'description' => $this->description,
            'packaging' => $this->packaging,
            'property' => PropertyResource::collection($this->whenLoaded('productPropertyValues')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'catag' => new TagCategoryResource($this->whenLoaded('category')),
            'image_url' => $this->imageUrl('vitrin', 'vitrin-thumb'),
        ];
    }
}
