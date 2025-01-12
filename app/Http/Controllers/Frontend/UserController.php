<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userProfile(){
        $profileData = Auth::user();
        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    public function userProfileUpdate(AdminProfileUpdateRequest $request)
    {

        try {
            $id = Auth::user()->id;
            $data = User::find($id);

            $data->name     = $request->name;
            $data->username = $request->username;
            $data->email    = $request->email;
            $data->phone    = $request->phone;
            $data->address  = $request->address;

            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('uploads/user_images/'.$data->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('uploads/user_images'), $filename);
                $data['image'] = $filename;
            }

            $data->save();

            $notification = array(
                'message' => 'User Profile Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function userPasswordUpdate(AdminChangePasswordRequest $request)
    {
        try {
            if(!Hash::check($request->old_password, Auth::user()->password)){
                throw new CustomException('The old password is incorrect.');
            }

            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();

            $notification = array(
                'message' => 'Change Password Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (CustomException $exception) {
            return back()->withErrors(['old_password' => $exception->getMessage()]);
        }catch (Exception $exception){
            throw $exception;
        }
    }

    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
