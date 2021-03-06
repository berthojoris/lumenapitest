<?php

namespace App\Http\Resources;

use App\Http\Resources\ItemResource;
use Illuminate\Http\Resources\Json\Resource;

class ChecklistResource extends Resource
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
            'updated_at' => $this->updated_at,
            'checklist_item' => ItemResource::collection($this->whenLoaded('checklistItem'))
        ];
    }
}