<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChecklistHasItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'checklist_id' => $this->checklist_id,
            'item_id' => $this->item_id,
        ];
    }
}