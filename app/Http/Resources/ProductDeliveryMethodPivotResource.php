<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ProductDeliveryMethodPivotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'additional_cost' => $this->additional_cost,
            'currency' => $this->currency,
            'estimated_days_min' => $this->estimated_days_min,
            'estimated_days_max' => $this->estimated_days_max,
            'availability_type' => $this->availability_type,
            'location_name' => $this->location_name, //CEVIRI CALISYOR  
            'custom_notes' => $this->custom_notes, //CEVIRI CALISYOR
            'custom_attributes' => $this->custom_attributes, //CEVIRI CALISIYOR
            'specific_details' => $this->specific_details
        ];
    }
}
