<?php
namespace App\Http\Controllers;

use App\Checklist;
use App\Helpers\Output;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function createChecklist(Request $request)
    {
        if ($request->isJson()) {
            $data = $request->input('data.attributes');

            if(!empty($data)) {

                $saved = Checklist::create([
                    'object_domain' => $data['object_domain'],
                    'object_id' => $data['object_id'],
                    'description' => $data['description'],
                    'due' => $data['due'],
                    'urgency' => $data['urgency']
                ]);

                $pass = Checklist::find($saved->id);
                
                return Output::checklist($pass, 201);
            } else {
                return Output::simple(400);
            }
        } else {
            return Output::simple(400);
        }
    }

    public function updateChecklist($checklistID, Request $request)
    {
        if ($request->isJson()) {
            $data = $request->input('data.attributes');

            if(!empty($data)) {
                $check = Checklist::find($checklistID);

                if(!empty($check)) {

                    $check ->update([
                        'object_domain' => $data['object_domain'],
                        'object_id' => $data['object_id'],
                        'description' => $data['description'],
                        'is_completed' => ($data['is_completed'] == true) ? 1 : 0,
                        'completed_at' => null,
                        'created_at' => Output::convertFromISO8601($data['created_at'])
                    ]);

                    return Output::checklist($check, 200);
                } else {
                    return Output::simple(404);
                }
            } else {
                return Output::simple(400);
            }
        } else {
            return Output::simple(400);
        }
    }

    public function deleteChecklist($checklistID)
    {
        return "DELETED";
    }

    public function getChecklist($checklistID)
    {
        return "INDEX";
    }
}
