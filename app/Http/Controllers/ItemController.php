<?php

namespace App\Http\Controllers;

use App\Item;
use App\Helpers\Output;
use App\ChecklistHasItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function createdata(Request $request)
    {   
        if ($request->isJson()) {
            
            $data = $request->input('data.attribute');

            if(!empty($data)) {

                DB::beginTransaction();

                try {

                    $saved = Item::create([
                        'description' => $data['description'],
                        'due' => $data['due'],
                        'urgency' => $data['urgency']
                    ]);

                    ChecklistHasItem::create([
                        'checklist_id' => $request->segment(2),
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

    public function getdata()
    {
        return "OK";
    }
}
