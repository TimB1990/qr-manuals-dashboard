<?php

// php artisan make:auth

// when successfull authenticated redirect to home
// protected $redirectTo = '/';

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

Route::get('profile', function(){
   // only authenticated users may enter...
})->middleware('auth');

// call middleware from controllers constructor
public function __construct(){
   $this->middleware('auth');
}

// app/Http/Middleware/Authenticate.php modify redirect path
protected function redirectTo($request){
   return route('login');
}

// to specify which guard to authenticate the user. The guard specified should correspond to the one of the keys in the guards array of your auth.php configuration file

public function __construct(){
   $this->middleware('auth:api')
}

// manual authentication
class LoginController extends Controller{
   public function authenticate(Request $request){
      $credentials = $request->only('email', 'password');

      if(Auth::attempt($credentials)){
         // authentication passed...
         return redirect()->intended('dashboard');
      }
   }
}

// extra conditions to authentication query in addition to the user's email and password. We may verify if the user is marked as 'active'

$credentials = [
   'email' => $email, 
   'password' => $password,
   'active' => 1
];

if(Auth::attempt($credentials)){
      // the user is active, not suspended and exists
   }

// specification of which guard instance you would like to utilize
if (Auth::guard('admin')->attempt($crendentials))){
   //
}

// logout user
Auth::logout();

// remember me functionality
$credentials = [
   'email' => $email, 
   'password' => $password,
   'active' => 1
];

if(Auth::attempt($credentials, $remeber)){
   // the user is being remembered
}

// to check if user was authenticated using remember me cookie
if(Auth::viaRemember()){
   //
}

// authenticate a user instance

Auth::login($user);
// login and remeber...
Auth::login($user, true);

// guard instance
Auth::guard('admin')->login($user);

// authenticate by user id

Auth::loginUsingId(1);
// Login and "remember" the given user...
Auth::loginUsingId(1, true);


/*
+---------------------------+
| API AUTHENTICATION OAuth2 |
+---------------------------+
*/

// composer require laravel/passport
// php artisan migrate
// php artisan passport:install

// AuthServiceProvider.php
use Laravel\Passport\Passport;

public function boot(){
   $this->registerPolicies();
   Passport::routes();
}

// finally in auth.php you should set driver option of api authentication guard to passport. This will instruct the appliction to use Passports TokenGuard, when authenticating incoming requests










