<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        if(isset($data['role'])){
            $rules['phone'] = 'required|numeric|min:10';
            $rules['rfc'] = [
                'required',
                'min:13',
                'regex:/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/'
            ];
            $rules['bank'] = 'required';
            $rules['clabe'] = 'required';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $user_data = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ];

        if(isset($data['role']))
            $user_data['role'] = 'seller';

        $user = User::create($user_data);

        $profile_data = [
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ];

        if(isset($data['role'])){
            $profile_data['company'] = $data['company'];
            $profile_data['phone'] = $data['phone'];
            $profile_data['rfc'] = $data['rfc'];
            $profile_data['bank'] = $data['bank'];
            $profile_data['clabe'] = $data['clabe'];
        }

        $user->profile()->create($profile_data);

        return $user;
    }
}
