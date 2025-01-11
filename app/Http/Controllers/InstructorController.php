<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\Admin\AdminChangePasswordRequest;
use App\Http\Requests\Admin\AdminProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function InstructorDashboard()
    {
        return view('instructor.index');
    }

    public function InstructorLogin()
    {
        return view('instructor.instructor_login');
    }

    public function InstructorProfile()
    {

        $profileData = Auth::user();
        return view('instructor.instructor_profile_view', compact('profileData'));
    }

    public function InstructorProfileStore(AdminProfileUpdateRequest $request)
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
                @unlink(public_path('uploads/instructor_images/'.$data->image));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('uploads/instructor_images'), $filename);
                $data['image'] = $filename;
            }

            $data->save();

            $notification = array(
                'message' => 'Instructor Profile Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function InstructorChangePassword()
    {
        $id          = Auth::user()->id;
        $profileData = User::find($id);

        return view('instructor.instructor_change_password', compact('profileData'));
    }

    public function InstructorPasswordUpdate(AdminChangePasswordRequest $request)
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

    public function InstructorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }
}
