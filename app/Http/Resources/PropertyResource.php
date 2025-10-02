<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PropertyResource extends JsonResource
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
            'name' => $this->property?->name,
            'prop_value_type' => $this->value_parse_type,
            'value' => $this->value,
            'numeric' => $this->numeric,
            'type' => $this->property_type,
            'unit' => new UnitResource($this->whenLoaded('unit'))
        ];
    }
}
