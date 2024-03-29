<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemVarSeeder::class);
        $this->call(StatesTableSeeder::class);

        if( $_ENV['APP_ENV'] === 'local'){
          $this->call(UsersTableSeeder::class);
          $this->call(MemberSeeder::class);
          $this->call(DocumentSeeder::class);
        }

        if( $_ENV['APP_ENV'] === 'staging'){
          //dont bother doing members
          $this->call(UsersTableSeeder::class);
          $this->call(DocumentSeeder::class);
        }
    }
}
