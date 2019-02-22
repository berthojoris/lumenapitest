<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Checklist extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'checklist';
    protected $hidden = ['id'];

    public function getIsCompletedAttribute($value)
    {
        return ($value === 0) ? false : true;
    }
}