<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    //

    public function index(Request $request)
    {
        return view("backend.permissions.index");
    }

    public function all_permissions()
    {

        $permissions = Permission::all();
        return response()->json([
            "permissions" => $permissions
        ]);
    }

    public function allRoles()
    {

        $roles = Role::all();
        return response()->json([
            "roles" => $roles
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'permission_link' => 'required|url',
            'role_id' => 'required',

        ], [
            'name.required' => translate("please enter title permission"),
            'permission_link.required' => translate("please enter link permission"),
            'permission_link.url' => translate("please sure link permission is url"),
            'role_id.required' => translate("please enter role"),

        ]);


        if ($validator->fails()) {

            return response()->json(['status' => 0, 'msg' => $validator->errors()]);
        }


        $permission =   Permission::create($request->except("_token"));

        if ($permission) {
            return response()->json([
                "status" => 1,
                "msg" => "done"
            ]);
        }
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $roles = Role::all();

        return response()->json([
            "permission" => $permission,
            "roles" => $roles
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'permission_link' => 'required|url',
            'role_id' => 'required',

        ], [
            'name.required' => translate("please enter title permission"),
            'permission_link.required' => translate("please enter link permission"),
            'permission_link.url' => translate("please sure link permission is url"),
            'role_id.required' => translate("please enter role"),

        ]);


        if ($validator->fails()) {

            return response()->json(['status' => 0, 'msg' => $validator->errors()]);
        }

        $permission = Permission::find($request->id);

        if (!empty($permission)) {
            $permission->update($request->except("_token"));
            return response()->json(['status' => 1, 'msg' => "done"]);
        } else {
            return response()->json(['status' => 0, 'msg' => ["user" => translate("the user is empty")]]);
        }
    }
}
