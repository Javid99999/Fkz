<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class DeliveryResponsibilityResource extends JsonResource
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
            'responsi_type' => $this->responsibility_type->value,
            'responsibility' => $this->responsibility_value


            // === 'buyer'
            // ? $this->getTranslation('responsibility_value', App::getLocale()) ?? $this->getTranslation('responsibility_value', 'en')
            // : null,

            // 'res' => $this->responsibility_value

            // 'name' => $this->getTranslation('responsibility_value', App::getLocale()) ?? $this->getTranslation('responsibility_value', 'en'),
        ];
    }
}
