<?php

namespace App\Http\Controllers\Auth;

use App\User;
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createUser(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'status' => 'unapproved',
	        'user_code' => $this->generateUserCode()
        ]);

	    redirect('/tshirt/' . $user->userCode);
    }

    private function generateUserCode(){
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $randstring = '';
	    for ($i = 0; $i < 3; $i++) {
		    $randstring .= $characters[rand(0, strlen($characters))];
	    }
	    return $randstring;

    }
}
