<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PoductDelMethResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'id'          => $this->id,
            'code'        => $this->code,
            'expansion'   => $this->expansion,
            'description' => $this->description,
            'responsib'   => DeliveryResponsibilityResource::collection($this->whenLoaded('responsibilities')),
            'extradetail' => new ProductDeliveryMethodPivotResource($this->whenLoaded('pivot')),
        ];
    }
}
