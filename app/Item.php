<?php

class Item extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'item';
    
    protected function getDateFormat()
    {
        return 'd.m.Y H:i:s';
    }
}