<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class profileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        DB::select("UPDATE `users` SET `first_name` = '" . $request->input('first_name') . "', `last_name` = '" . $request->input('last_name') . "' WHERE `users`.`id` = 1");

        // $user->fill($request->post())->save();

        return redirect('/profile')->with('success', 'Profile Has Been updated successfully');
    }


    public function update_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'newPassword' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $newPass = Hash::make($request->input('newPassword'));

            DB::select("UPDATE `users` SET `password` = '" . $newPass . "' WHERE `users`.`id` = " . Auth::id());

            // Logout
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('success', 'Password has been changed successfully, login again.');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Current password is wrong.']);
        }


        return redirect('/profile')->with('success', 'Profile Has Been updated successfully');
    }
}
