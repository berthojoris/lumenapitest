<?php
namespace App;
use DateTime;
use Carbon\Carbon;
use App\Helpers\Output;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'checklist';
    // protected $hidden = ['id'];

    public function getIsCompletedAttribute($value)
    {
        return ($value === 0) ? false : true;
    }

    public function getCreatedAtAttribute($value)
    {
        return Output::convertToISO8601($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Output::convertToISO8601($value);
    }

    public function checklistItem()
    {
        return $this->hasMany(ChecklistHasItem::class, 'checklist_id', 'id')
            ->join('item', 'item.id', '=', 'checklist_has_items.checklist_id');
    }
}