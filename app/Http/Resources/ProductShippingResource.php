<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'loadsend' => new ShippingResource($this->whenLoaded('deliverInfo')),
            'wrapping' => ProductPackaging::collection($this->whenLoaded('productPackaging')),
            'reqdocks' => RequiredDocks::collection($this->whenLoaded('requireDoc')),
            'country' => new CountryResource($this->country),
        ];
    }
}
