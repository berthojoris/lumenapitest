<?php
namespace App\Http\Controllers;

use App\Checklist;
use App\Helpers\Output;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\ChecklistResource;
use App\Http\Resources\ChecklistResourceOne;

class ChecklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $check = Checklist::find($checklistID);
        if(!empty($check)) {
            $check->delete();
            return Output::nocontent(204);
        } else {
            return Output::simple(404);
        }
    }

    public function getOneChecklist(Request $request, $checklistID)
    {
        $result = Checklist::with('checklistItem')->find($checklistID);

        if($request->has('include')) {
            if($request->input('include') == 'items') {
                $result = new ChecklistResource($result);
                return Output::oneWithInclude($result, 200, 'checklists');
            }
        } else {
            return Output::oneRow($result, 200, 'checklists');
        }
    }

    public function getChecklist(Request $request, Checklist $checklist)
    {   
        $query = Checklist::Query();

        // Sementara query param saya taruh disini aja, nantinya bisa di refactor agar lebih clean

        if($request->has('sort')) {
            $query->orderBy('id', $request->input('sort'));
        }

        if($request->has('filter')) {
            $query->where('object_domain', 'like', '%'.$request->input('filter').'%');
        }

        if($request->has('fields')) {
            // Gak paham saya param field buat filter data yg mana
        }

        if($request->has('include')) {
            if($request->input('include') == 'items') {
                $query = ChecklistResource::collection($checklist->with('checklistItem')->paginate(2));
                $result = $query->appends(['page[limit]' => 2, 'page[offset]' => 0]);
            } else {
                return Output::simple(400);
            }
        } else {
            $result = $query->paginate(2);
            $result->appends(['page[limit]' => 2, 'page[offset]' => 0]);
        }

        return Output::list($result, 200, 'checklists');
    }
}
