<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'object_domain' => $this->object_domain,
            'object_id' => $this->object_id,
            'description' => $this->description,
            'is_completed' => $this->is_completed,
            'completed_at' => $this->completed_at,
            'updated_by' => $this->updated_by,
            'due' => $this->due,
            'urgency' => $this->urgency,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}