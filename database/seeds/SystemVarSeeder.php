<?php

use Illuminate\Database\Seeder;
use App\SystemVar;

class SystemVarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system')->truncate();
        SystemVar::create([ 'name' => "trial_days", 'value' => "15" ]);
        SystemVar::create([ 'name' => "org_small", 'value' => "100"]);
        SystemVar::create([ 'name' => "org_med", 'value' => "200"]);
    }
}
