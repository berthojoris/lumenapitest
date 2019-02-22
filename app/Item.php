<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Item extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'item';
    
    // public function getDateFormat()
    // {
    //     return 'd.m.Y H:i:s';
    // }
}