<?php
namespace App;
use App\Helpers\Output;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'item';

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
}