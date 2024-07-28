<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi input dari request
            $validatedData = $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'weight' => 'required|integer|min:0',
                'height' => 'required|integer|min:0',
                'gender' => 'required|string|in:male,female',
                'birthday' => 'required|date',
            ]);

            // Hash password sebelum menyimpan ke database
            $validatedData['password'] = Hash::make($request->password);

            // Buat user baru
            User::create($validatedData);

            return redirect()->route('users')->with('create_success', 'User created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['create_failed' => $e->getMessage()])->withInput();
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'fullname' => 'string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'weight' => 'required|integer|min:0',
                'height' => 'required|integer|min:0',
                'gender' => 'required|string|in:male,female',
                'birthday' => 'required|date',
            ]);

            $user->update($validatedData);

            return redirect()->route('users')->with('edit_success', 'User updated successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->route('edit-user-form', ['id' => $id])->with('edit_failed', 'Failed to update user.');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('users')->with('delete_success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('users')->with('delete_failed', 'Failed to delete user.');
        }
    }


}