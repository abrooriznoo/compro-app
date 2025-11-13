<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function store(Request $request)
    {
        // Buat validator manual
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sama.', // pesan custom
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            // Redirect ke route('admin.users') dengan error pertama
            return redirect()->route('admin.users')
                ->with('error', $validator->errors()->first());
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // jangan lupa encrypt password
        ]);

        // Redirect dengan pesan success
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Buat validator manual
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->route('admin.users')
                ->with('error', $validator->errors()->first());
        }

        // Validasi sukses, update user
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        // Find the user by ID and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect to the users list with a success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
