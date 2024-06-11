<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminListDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminListController extends Controller
{
    public function index(AdminListDataTable $dataTable)
    {
        return $dataTable->render('Staff.admin-list.index');
    }

    public function changeStatus(Request $request)
    {
        $admin = User::findOrFail($request->id);
        $admin->status = $request->status == 'true' ? 'active' : 'inactive';
        $admin->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destory(string $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully']);

    }
}
