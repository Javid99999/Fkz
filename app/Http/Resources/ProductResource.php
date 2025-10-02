<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

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
            'id' => $this->id,
            // 'locale' => App::getLocale(),
            'name' => $this->name,
            'cas_number' => $this->cas_number,
            'description' => $this->description,
            'packaging' => $this->packaging,
            'country' => new CountryResource($this->whenLoaded('country')),
            'classification' => ClassificationResource::collection($this->whenLoaded('productClassification')),
            'statements' => StatementResource::collection($this->whenLoaded('productStatements')),
            'picto' => PictogramResource::collection($this->whenLoaded('productPictogram')),
            'property' => PropertyResource::collection($this->whenLoaded('productPropertyValuess')),
            // 'image_vitrin_url' => $this->imageUrl('vitrin', 'vitrin-thumb'),
            'img_url'=> $this->mediaUrls('detailfoto'),
        ];
    }
}
