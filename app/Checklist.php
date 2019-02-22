<?php

class Checklist extends Model {
    
    protected $guarded = ['id'];
    protected $table = 'checklist';
    
    protected function getDateFormat()
    {
        return 'd.m.Y H:i:s';
    }
}