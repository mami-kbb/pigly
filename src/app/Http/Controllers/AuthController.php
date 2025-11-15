<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\WeightTargetRequest;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;


class AuthController extends Controller
{
    public function showStep1()
    {
        return view('auth.register');
    }

    public function storeStep1(UserRequest $request)
    {
        $request->session()->put('register',[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/register/step2');
    }

    public function showStep2(Request $request)
    {
        if (!$request->session()->has('register')) {
            return redirect('/register/step1');
        }
        return view('auth.first_target');
    }

    public function storeStep2(WeightTargetRequest $request)
    {
        if (!$request->session()->has('register')) {
            return redirect('/register/step1');
        }

        $registerData = $request->session()->get('register');

        $user = User::create([
            'name' => $registerData['name'],
            'email' => $registerData['email'],
            'password' => $registerData['password'],
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $request->current_weight,
        ]);

        $request->session()->forget('register');

        Auth::login($user);

        return redirect('/weight_logs');
    }

}
