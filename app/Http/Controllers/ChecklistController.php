<?php
namespace App\Http\Controllers;

class ChecklistController extends Controller
{
    public function createChecklist()
    {
        return "CREATED";
    }

    public function updateChecklist()
    {
        return "UPDATED";
    }

    public function deleteChecklist()
    {
        return "DELETED";
    }

    public function getChecklist($checklistID)
    {
        return "INDEX";
    }
}
