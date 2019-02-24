<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class ChecklistHasItem extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'checklist_has_items';

    public function checklist()
    {
        return $this->belongsTo(Checklist::class, 'id', 'checklist_id');
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
}