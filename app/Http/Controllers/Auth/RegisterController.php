<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Fee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Session;
use Redirect;

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
    protected $redirectTo = '/';

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
    protected function validator(array $data){

      // dd($data);
      $validator = Validator::make($data, [
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:8|confirmed',
          'org_name' => 'required',
          'name' => 'required|string|max:255',
          'phone' => 'required|digits:10',
          'address' => 'required',
          'city' => 'required',
          'state' => 'required',
          'zip' => 'required|digits:5',

          'billing_name' => 'required|string|max:255',
          'billing_phone' => 'required|digits:10',
          'billing_address' => 'required',
          'billing_city' => 'required',
          'billing_state' => 'required',
          'billing_zip' => 'required|digits:5',

          'org_size' => 'required|numeric',
          'stripeToken' => 'required'
      ]);

      if($validator){
        return $validator;
      }else{
        return back()->withInput()->withErrors($validator);
      }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      // dd($data);
        Session::flash('info', 'Welcome to IAgreek! For the best tailored expierence, you should make sure all fields below are completed.');
        $new_user =  User::create([
              'email' => $data['email'],
              'password' => bcrypt($data['password']),
              'org_name' => $data['org_name'],
              'name' => $data['name'],
              'phone' => preg_replace("/[^0-9]/", "", $data['phone']),
              'address' => $data['address'],
              'city' => $data['city'],
              'state' => $data['state'],
              'zip' => $data['zip'],
              'website' => $data['website'],
              'org_type' => $data['org_type'],

              'billing_name' => $data['billing_name'],
              'billing_phone' => $data['billing_phone'],
              'billing_address' => $data['billing_address'],
              'billing_city' => $data['billing_city'],
              'billing_state' => $data['billing_state'],
              'billing_zip' => $data['billing_zip'],

              'org_size' => $data['org_size'],
        ]);

        try{
        $new_user->newSubscription('subscription', Fee::determineNewUserSubType( (int)$data['org_size'] ) )->create($data['stripeToken'],[
                'email' => $new_user->email
              ]);
        }catch(\Stripe\Error\Card $e) {
            $body = $e->getJsonBody();
            $err  = $body['error'];
            Session::flash('failure',$err['message']);
            User::find($new_user->id)->delete();
            return Redirect::to('/register')->withInput()->send();
        }

        return $new_user;
    }
}
