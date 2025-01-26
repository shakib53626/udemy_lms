<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AllUserController extends Controller
{
    public function allInstructor(){
        $allInstructor = User::where('role', 'instructor')->get();

        return view('admin.backend.all_user.all_instructor', compact('allInstructor'));
    }

    public function updateUserStatus(Request $request){

        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);

        $user = User::find($userId);
        if($user){
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully']);
    }
}
