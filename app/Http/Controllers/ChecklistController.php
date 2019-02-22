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
                
                return Output::checklist($pass);
            }
        }
    }

    public function updateChecklist($checklistID)
    {
        return "UPDATED";
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
