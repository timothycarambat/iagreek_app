<?php

use Illuminate\Database\Seeder;

use App\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach(range(1,16) as $i) {
       $new_guy = new Member;
       $new_guy->name = "John ".str_random(5);
       $new_guy->email = str_random(10)."@iagreek.com";
       $new_guy->password = bcrypt("hello");
       $new_guy->position = "member";
       $new_guy->status = "active";
       $new_guy->org_admin_id = 1; //just attached to admin
       $new_guy->save();
      }
    }
}
