<?php
namespace App\Helpers;

use DateTime;
use Carbon\Carbon;

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
}