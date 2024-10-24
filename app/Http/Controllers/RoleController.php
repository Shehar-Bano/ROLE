<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Role::all();
        return response()->json($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',
        ]);

        // Create a new permission
        Role::create(['name' => $request->name]);

        // Redirect back to permission list with success message
        return response()->json([
            'success' => true,
            'message' => 'Role created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Role::findOrFail($id);
        return response()->json([
            'data'=> $permission

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id . '|max:255',
        ]);

        // Find the permission and update it
        $permission = Role::findOrFail($id);
        $permission->update(['name' => $request->name]);

        // Redirect back to permission list with success message
        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Role::findOrFail($id);
        $permission->delete();
        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ]);
    }
    public function goToPage(Request $request)
    {
        $user = Auth::user();

        $roles = Role::all();
        $users = User::all();
        $permissions = Permission::all();
        return view('permissionSync',compact('roles','users','user','permissions'));

    }
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::find($request->user_id);
        $role = $request->role;

        if ($user->hasRole($role)) {
            return redirect()->back()->with('error', 'User already has this role.');
        }
        $user->assignRole($role);
        return redirect()->back()->with('success', 'Role assigned successfully!');
    }
    public function getPermissions(Request $request)
    {
        $request->validate([
            'permission_id' => 'required',
            'role_id' =>'required|exists:roles,id',
        ]);
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);
        if($role->hasPermissionTo($permission) == false)
        {
            $role->givePermissionTo($permission);
            return redirect()->back()->with('success', 'Role assigned successfully!');
        }
        else
        {
            return redirect()->back()->with('error', 'permission already assigned to role');

        }

    }
}
