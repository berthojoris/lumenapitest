<?php
namespace App\Helpers;
 
class Output {
    
    public static function checklist($data)
    {
        $output = [
            'data' => [
                'type' => 'checklists',
                'id' => $data->id,
                'attributes' => $data,
                'links' => [
                    'self' => url('checklists/'.$data->id)
                ]
            ]
        ];
        return $output;  
    }
}