<?php

namespace App\Http\Controllers;

use App\Item;
use App\Checklist;
use App\Helpers\Output;
use App\ChecklistHasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function createdata(Request $request, $checklistID)
    {   
        if ($request->isJson()) {
            
            $data = $request->input('data.attribute');

            if(!empty($data)) {

                DB::beginTransaction();

                try {

                    $checklist = Checklist::findOrFail($checklistID);

                    $saved = Item::create([
                        'description' => $data['description'],
                        'due' => $data['due'],
                        'urgency' => $data['urgency']
                    ]);

                    ChecklistHasItem::create([
                        'checklist_id' => $checklistID,
                        'item_id' => $saved->id
                    ]);

                    DB::commit();

                    $pass = Item::find($saved->id);

                    return Output::checklist($pass, 201);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $e->getMessage();
                }

            } else {
                return Output::simple(400);
            }
        }
    }

    public function updatedata(Request $request, $checklistID, $itemID)
    {
        if ($request->isJson()) {
            $data = $request->input('data.attribute');
            if(!empty($data)) {

                $item = Item::findOrFail($itemID);
                $checklist = Checklist::findOrFail($checklistID);

                $updated = $item->update([
                    'description' => $data['description'],
                    'due' => $data['due'],
                    'urgency' => $data['urgency']
                ]);

                $pass = Item::find($itemID);
                return Output::checklist($pass, 200);
            }
        }
    }

    public function deletedata(Request $request, $checklistID, $itemID)
    {
        $item = Item::findOrFail($itemID);
        $checklist = Checklist::findOrFail($checklistID);

        DB::beginTransaction();

        try {
            DB::table('checklist_has_items')->whereChecklistId($checklistID)->whereItemId($itemID)->delete();
            $item->delete();
            DB::commit();
            return Output::nocontent(204);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
