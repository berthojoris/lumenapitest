<?php

namespace App\Http\Resources;

use App\Helpers\Output;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'description' => $this->description,
            'is_completed' => $this->is_completed,
            'completed_at' => $this->completed_at,
            'due' => $this->due,
            'urgency' => $this->urgency,
            'updated_by' => $this->updated_by,
            'created_at' => Output::convertToISO8601($this->created_at),
            'updated_at' => Output::convertToISO8601($this->updated_at)
        ];
    }
}