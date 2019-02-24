<?php
namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class Output {

    public static function convertToISO8601($string)
    {
        $dt = Carbon::createFromFormat('Y-m-d H:i:s', $string);
        return $dt->format(DateTime::ISO8601);
    }

    public static function convertFromISO8601($string)
    {
        return Carbon::parse($string);
    }

    public static function nocontent($httpcode)
    {
        return response()->json([], $httpcode);
    }

    public static function simple($httpcode)
    {
        if($httpcode == 200) {
            $msg = "Success";
        } else if ($httpcode == 201) {
            $msg = "Created";
        } else if ($httpcode == 500) {
            $msg = "Internal Server Error";
        } else if ($httpcode == 401) {
            $msg = "Unauthorized";
        } else if ($httpcode == 403) {
            $msg = "Forbidden";
        } else if ($httpcode == 404) {
            $msg = "Not Found";
        } else if ($httpcode == 400) {
            $msg = "Bad Request";
        } else if ($httpcode == 405) {
            $msg = "Method Not Allowed";
        } else {
            $msg = "Not Defined";
        }
        
        return response()->json([
            'status' => $httpcode,
            'error' => $msg
        ], $httpcode);
    }

    public static function checklist($data, $httpcode)
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
        return response()->json($output, $httpcode);
    }

    public static function wrap($data, $type)
    {
        $newformat = [];
        foreach($data as $in) {
            array_push($newformat, [
                'type' => $type,
                'id' => $in['id'],
                'attributes' => [
                    'object_domain' => $in['object_domain'],
                    'object_id' => $in['object_id'],
                    'description' => $in['description'],
                    'is_completed' => $in['is_completed'],
                    'due' => $in['due'],
                    'urgency' => $in['urgency'],
                    'completed_at' => $in['completed_at'],
                    'last_update_by' => $in['updated_by'],
                    'update_at' => $in['updated_at'],
                    'created_at' => $in['created_at']
                ],
                'links' => [
                    'self' => url('checklists/'.$in['id'])
                ]
            ]);
        }
        return $newformat;
    }

    public static function list($data, $httpcode, $type)
    {
        $output = $data->toArray();

        $response = [
            'meta' => [
                'count' => ($output['total'] == 0) ? 0 : $output['per_page'],
                'total' => $output['total'],
            ],
            'links' => [
                'first' => $output['first_page_url'],
                'last' => $output['last_page_url'],
                'next' => $output['next_page_url'],
                'prev' => $output['prev_page_url']
            ],
            'data' => self::wrap($data, $type)
        ];
    
        return response()->json($response, $httpcode);
    }

    public static function oneWithInclude($data, $httpcode, $type)
    {
        $response = [
            'type' => $type,
            'id' => $data['id'],
            'attributes' => [
                'object_domain' => $data['object_domain'],
                'object_id' => $data['object_id'],
                'description' => $data['description'],
                'is_completed' => $data['is_completed'],
                'due' => $data['due'],
                'urgency' => $data['urgency'],
                'completed_at' => $data['completed_at'],
                'last_update_by' => $data['updated_by'],
                'update_at' => $data['updated_at'],
                'created_at' => $data['created_at']
            ],
            'links' => [
                'self' => url('checklists/'.$data['id'])
            ]
        ];
    
        return response()->json($response, $httpcode);
    }

    public static function oneRow($data, $httpcode, $type)
    {
        $output = $data->toArray();

        $response = [
            'type' => $type,
            'id' => $output['id'],
            'attributes' => [
                'object_domain' => $output['object_domain'],
                'object_id' => $output['object_id'],
                'description' => $output['description'],
                'is_completed' => $output['is_completed'],
                'due' => $output['due'],
                'urgency' => $output['urgency'],
                'completed_at' => $output['completed_at'],
                'last_update_by' => $output['updated_by'],
                'update_at' => $output['updated_at'],
                'created_at' => $output['created_at']
            ],
            'links' => [
                'self' => url('checklists/'.$output['id'])
            ]
        ];
    
        return response()->json($response, $httpcode);
    }
}