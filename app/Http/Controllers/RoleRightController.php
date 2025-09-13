<?php

namespace App\Http\Controllers;

use App\Models\Right;
use App\Models\Role;
use App\Models\RoleRight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Session;


class RoleRightController extends Controller
{
    
    public function indexRole() {
        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    public function createRole() {
        return view('backend.role.create');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        try {
            $data = new Role();
            $data->name = $request->name;
            $data->save();
            return redirect()->route('index.role')->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.role')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function editRole($id){
        $roles['role'] = Role::find($id);
        if (!$roles['role']) {
            return redirect()->back();
        }     
        return view('backend.role.edit', $roles);
    }

    public function updateRole(Request $request, $id)
    {
         $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
        ]);

        
        try {
            $data = Role::findOrFail($id);
            $data->name = $request->input('name');
            $data->save();

            return redirect()->route('index.role')->with('success', 'Data update successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.role')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function deleteRole($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return redirect()->route('index.role')->with('error', 'Role not found.');
            }

            $role->delete();

            return redirect()->route('index.role')->with('success', 'Role deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.role')->with('error', 'An error occurred while deleting the role.');
        }
    }


    // Show all rights
    public function indexRight() {
        $rights = Right::all();
        return view('backend.right.index', compact('rights'));
    }

    // Show create form
    public function createRight() {
        return view('backend.right.create');
    }

    // Store new right
    public function storeRight(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:rights,name',
            'module' => 'required|string',
        ]);

        try {
            $right = new Right();
            $right->name = $request->module . '.' . $request->name;
            $right->module = $request->module;
            $right->save();

            return redirect()->route('index.right')->with('success', 'Right created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.right')->with('error', 'An error occurred. Please try again.');
        }
    }

    // Show edit form
    public function editRight($id) {
        $rights['right'] = Right::find($id);
        if (!$rights['right']) {
            return redirect()->back();
        }
        return view('backend.right.edit', $rights);
    }

    // Update right
    public function updateRight(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|unique:rights,name,' . $id,
            'module' => 'required|string',
        ]);

        try {
            $right = Right::findOrFail($id);
            $right->name = $request->module . '.' . $request->name;
            $right->module = $request->module;
            $right->save();

            return redirect()->route('index.right')->with('success', 'Right updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.right')->with('error', 'An error occurred. Please try again.');
        }
    }

    // Delete right
    public function deleteRight($id) {
        try {
            $right = Right::find($id);
            if (!$right) {
                return redirect()->route('index.right')->with('error', 'Right not found.');
            }

            $right->delete();
            return redirect()->route('index.right')->with('success', 'Right deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.right')->with('error', 'An error occurred while deleting the right.');
        }
    }



    public function getRoleForRight() {
        $roles = Role::all();
        return view('backend.role-right.index', compact('roles'));
    }


    public function getRightForRole(Request $request, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('index.role')->with('error', 'Invalid Role ID.');
        }

        $rights = Right::all()->groupBy('module');
        $selectedRights = RoleRight::where('role_id', $id)->pluck('right_id')->toArray();

        return view('backend.role-right.edit', compact('role', 'rights', 'selectedRights'));
    }


    public function updateRoleRights(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'selected_rights' => 'nullable|array',
            'selected_rights.*' => 'exists:rights,id'
        ]);

        try {
            $roleId = $request->role_id;
            $selectedRights = $request->selected_rights ?? [];

            // Remove old rights
            RoleRight::where('role_id', $roleId)->delete();

            // Insert new rights
            foreach ($selectedRights as $rightId) {
                RoleRight::create([
                    'role_id' => $roleId,
                    'right_id' => $rightId
                ]);
            }

            return redirect()->route('index.role')->with('success', 'Permissions updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('index.role')->with('error', 'An error occurred while updating permissions.');
        }
    }

}
