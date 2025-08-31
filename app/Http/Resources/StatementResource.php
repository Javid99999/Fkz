<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StatementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->statement->id,
            'name' => $this->statement->name,
            'securecode' => SecureCodeResource::collection($this->whenLoaded('securecodes'))
        ];

    }
}
