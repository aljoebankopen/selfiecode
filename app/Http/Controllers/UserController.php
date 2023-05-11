<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
        $user->otp_code = Str::random(6); // Generate a random 6-digit OTP code
        $user->save();

        // TODO: Send the OTP code to the user's phone number using a third-party SMS gateway service

        return redirect()->route('login')->with('success', 'Registration successful. Please check your phone for the OTP code.');
    }
}
