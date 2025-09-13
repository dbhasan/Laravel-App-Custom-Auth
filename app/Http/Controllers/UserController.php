<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    public function indexUser()
    {
        $users = User::with('role')->get();
        return view('backend.user.index', compact('users'));
    }


    public function createUser()
    {
        $roles = Role::all();
        return view('backend.user.create', compact('roles'));
    }


    public function storeUser(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6|confirmed', 
            'status' => 'nullable|string|in:active,inactive',
        ]);

        try {
            $user = new User();
            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password); // hash password
            $user->status = $request->status ?? 'active';
            $user->save();

            return redirect()->route('index.user')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.user')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('index.user')->with('error', 'User not found.');
        }
        return view('backend.user.edit', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|unique:users,phone,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->status = $request->status ?? $user->status;
            $user->save();

            return redirect()->route('index.user')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('index.user')->with('error', 'An error occurred. Please try again.');
        }
    }

}
