<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->name,
            'prop_value_type' => $this->pivot->value_parse_type,
            'value' => $this->pivot->value,
            'numeric' => $this->pivot->numeric,
            'type' => $this->property_type,
            'unit' => new UnitResource($this->unit)
        ];
    }
}
