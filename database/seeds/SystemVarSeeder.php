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

        SystemVar::create([ 'name' => "trial_days", 'value' => "30" ]);
        SystemVar::create([ 'name' => "trial_members", 'value' => "10" ]);
        SystemVar::create([ 'name' => "trial_documents", 'value' => "3" ]);
        SystemVar::create([ 'name' => "trial_campaigns", 'value' => "3" ]);

        SystemVar::create([ 'name' => "org_small", 'value' => "50"]);
        SystemVar::create([ 'name' => "org_med", 'value' => "199"]);
        SystemVar::create([ 'name' => "org_large", 'value' => "Unlimited"]);
        SystemVar::create([ 'name' => "iag_small", 'value' => "50"]);
        SystemVar::create([ 'name' => "iag_med", 'value' => "199"]);
        SystemVar::create([ 'name' => "iag_large", 'value' => "Unlimited"]);
    }
}
