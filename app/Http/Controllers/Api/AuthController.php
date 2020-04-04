<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMailable;
use App\PasswordReset;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()){
            return response()->json(['error' =>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('exalto')->accessToken;
        $success['name'] = $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }

    public function logout(){
        Auth::logout();
        return response()->json(true,200);
    }

    public function sendToken(Request $request){
        $user = User::where('email', $request->email)->first();

        if(!isset($user->id)){
            return response()->json(['error' => 'User with this email does not exist'], 401);
        }

        $token = str_random(32);

        Mail::to($user)->send(new ResetPasswordMailable($token));

        $passwordReset = new PasswordReset();
        $passwordReset->email = $user->email;
        $passwordReset->token = $token;
        $passwordReset->save();
    }

    public function validateToken(Request $request){
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if(!isset($passwordReset->email)){
            return response()->json(['error' => 'Invalid token'],401);
        }

        $user = User::where('email',$passwordReset->email)->first();
        return response()->json($user, 200);
    }

    public function resetPassword(Request $request){
        $user = User::find($request->user_id);
        $passwordReset = PasswordReset::where('email', $user->email)->first();
        $passwordReset->delete();

        $user->password = bcrypt($request->password);
        $user->save();
    }
}
