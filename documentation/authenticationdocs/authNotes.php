<?php

// php artisan make:auth

// when successfull authenticated redirect to home
protected $redirectTo = '/';

// if redirect path needs custom generation logic
protected function redirectTo(){
   return '/path'
}

// by default laravel uses email field for authentication. to customize, you may define a username method on your LoginController.php

public function username(){
   return 'username';
}

// customize the guard on your LoginController, RegisterController and ResetPasswordController

use Illuminate\Support\Facades\Auth;

protected function guard(){
   return Auth::guard('guard-name');
}

// validation / storge customization
// you are free to modify the RegisterController class responsible for validating and creating new users of your application

// retrieve authenticated user
$user = Auth::user();
$id = Auth::id();

// when user is authenticated you may access the authenticated user via an Illuminate\Http\Request

class ProfileController extends Controller{
   public function update(Request $request){
      // $request->user() returns an instance of auth. user
   }
}

// determine if current user is authenticated
if(Auth::check()){
   // the user is logged in.
}

/*
+-------------------+
| PROTECTING ROUTES |
+-------------------+
*/

