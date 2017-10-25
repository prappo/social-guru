<?php

namespace App\Http\Controllers\Auth;

use App\Package;
use App\Setting;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->type = 'user';
        $user->status = 'active';
        $user->save();
        //create pakcage for user

        $package = new Package();
        $package->userId = User::where('email', $data['email'])->value('id');
        $package->fb = "yes";
        $package->tw = "yes";
        $package->tu = "no";
        $package->wp = "no";
        $package->ln = "yes";
        $package->in = "yes";
        $package->fbBot = "no";
        $package->slackBot = "no";
        $package->pinterest = "yes";
        $package->contacts = "no";
        $package->save();

        // creating settings data for this user
        $settings = new Setting();
        $settings->userId = User::where('email', $data['email'])->value('id');
        $settings->save();

//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//        ]);

        return $user;
    }
}
