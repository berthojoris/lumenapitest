<?php
namespace App;
use DateTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'checklist';
    protected $hidden = ['id'];

    public function getIsCompletedAttribute($value)
    {
        return ($value === 0) ? false : true;
    }

    public function getCreatedAtAttribute($value)
    {
        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        return $dt->format(DateTime::ISO8601);
    }

    public function getUpdatedAtAttribute($value)
    {
        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $value);
        return $dt->format(DateTime::ISO8601);
    }
}