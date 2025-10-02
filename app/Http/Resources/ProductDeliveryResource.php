<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDeliveryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'delivery_methods' => PoductDelMethResource::collection($this->whenLoaded('deliveryMethods')),
            'available_countries' => CountryShipmentResource::collection($this->whenLoaded('productCountryShipment')),
            'productTerms' => ProductTermsResource::collection($this->whenLoaded('productTerms'))
        ];
    }
}
