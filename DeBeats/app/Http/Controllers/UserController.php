<?php

namespace App\Http\Controllers;

use App\Models\User; // Import this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import this for password hashing

class UserController extends Controller
{
    // Load all users for the Exam List page
    public function loadAllUsers(){
        $all_users = User::all(); // Retrieve all users from the database
        return view('exam-list', compact('all_users')); // Return the view with users data
    }

    // Other CRUD methods (Add, Edit, Delete, etc.) remain the same

    public function loadAddUserForm(){
        return view('add-user');
    }

    public function AddUser(Request $request){
        // Form validation and adding user logic
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required|confirmed|min:4|max:8',
        ]);
        try {
            $new_user = new User;
            $new_user->name = $request->full_name;
            $new_user->email = $request->email;
            $new_user->phone_number = $request->phone_number;
            $new_user->password = Hash::make($request->password);
            $new_user->save();

            return redirect('/users')->with('success', 'User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    public function EditUser(Request $request){
        // Form validation and updating user logic
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);
        try {
            $update_user = User::where('id', $request->user_id)->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            return redirect('/users')->with('success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('fail', $e->getMessage());
        }
    }

    public function loadEditForm($id){
        $user = User::find($id);
        return view('edit-user', compact('user'));
    }

    public function deleteUser($id){
        try {
            User::where('id', $id)->delete();
            return redirect('/users')->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }
}
