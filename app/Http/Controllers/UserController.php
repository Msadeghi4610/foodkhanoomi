<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //چک کردن تلفن همراه مه عضو هست یا خیر
    public function checkphone(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
        ]);
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            return redirect('/login')->withInput()->with('login','لطفا شماره موبایل و رمزعبور را وارد نمائید');
        } else {
            return redirect('/sign')->withInput()->with('sign',"کاربر گرامی جهت ورود به سایت  ابتدا ثبت نام نمائید");
        }
    }

    public function sign()
    {
        return view('user.sign');
    }

    public function login()
    {
        return view('user.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mobile_user' => ['required', 'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
            'name_user' => ['required', 'regex:/^[ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]+$/', 'min:7', 'max:30'],
            'password' => ['required', 'min:8', 'max:12'],
            'password_confirmation' => ['required', 'same:password'],
            'Address_user' => ['required', 'String'],
        ]);
        $user = User::where('mobile', $request->mobile_user)->first();
        if ($user) {
            return redirect()->back()->withErrors('شماره تلفن وارد شده قبلا ثبت نام کرده است');
        } else {
            $newuser = User::create([
                'name' => $request->name_user,
                'mobile' => $request->mobile_user,
                'Address' => $request->Address_user,
                'password' => $request->password,
            ]);
            Auth::login($newuser);
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function checklogin(Request $request)
    {
        $request->validate([
            'mobile_user' => ['required', 'regex:/^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}$/'],
            'password' => ['required'],
        ]);
        $user = User::where('mobile', $request->mobile_user)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if (Auth::user()->Access_user==2){
                    return view('dashbord');
                }else{
                    return redirect('/');
                }
            } else {
                return redirect()->back()->withErrors(' رمز عبور اشتباه میباشد');
            }
        } else {
            return redirect()->back()->withErrors('شماره تلفن یا رمز عبور اشتباه میباشد');
        }
    }

    public function edit()
    {
        return view('user.edituser');
    }

    public function update($userid,Request $request)
    {
        $request->validate([
            'name_user' => ['required', 'regex:/^[ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ\s]+$/', 'min:7', 'max:30'],
            'Address_user' => ['required', 'String'],
        ]);
        $user=User::findorfail($userid);
        if (is_null($user)){
            abort('404');
        }else{
            $user->update([
                'name'=>$request->name_user,
                'Address'=>$request->Address_user,
            ]);
            return redirect('user/edit')->with('successupdate','اطلاعات ویرایش شد');
        }
    }

    public function find(Request $request)
    {
        $request->validate([
            'finduser'=>['required'],
        ]);
        return redirect('/Admin')->withInput()->with('sucess_find',1);
    }

    public function delete($userid)
    {
        $user=User::findorfail($userid);
        if (is_null($user)){
            abort('404');
        }else{
            $name=$user->name;
            $user->delete();
            return redirect('/Admin')->with('deleteuser',"کاربر $name با موفقیت حذف شود");
        }
    }
}
