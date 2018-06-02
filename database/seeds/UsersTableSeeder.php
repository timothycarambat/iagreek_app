<?php

use Illuminate\Database\Seeder;
use App\User;
use Stripe\Token;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->truncate();
        DB::table('members')->truncate();
        DB::table('users')->truncate();

        //Make Admin
      $main_user = User::create([
        'email' => 'admin@iagreek.com',
        'password' => bcrypt('hello'),
        'org_name' => 'Iota Alpha Gamma',
        'name' => 'Nero Caeser',
        'phone' => "9855023261",
        'address' => "500 Rome Way",
        'city' => "Bologona",
        'state' =>"CA",
        'zip' => "77777",

        'billing_name' => 'Nero Caeser',
        'billing_phone' => "9855023261",
        'billing_address' => "500 Rome Way",
        'billing_city' => "Bologona",
        'billing_state' => "CA",
        'billing_zip' => "77777",
        'org_size' => "200",
        ]);

        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);
        $token = \Stripe\Token::create(array(
          "card" => array(
            "number" => "4242424242424242",
            "exp_month" => 12,
            "exp_year" => 2018,
            "cvc" => "314"
          )
        ));

       $main_user->newSubscription('main','iag_small')->create($token['id'],['email'=>$main_user->email]);


    }
}
