<?php

use Illuminate\Database\Seeder;

use App\Campaign;
use App\Document;
use App\User;
use App\Member;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaign = Campaign::create([
          'name' => 'Test Campaign',
          'document_id' => Document::first()->id,
          'org_admin_id' => User::first()->id,
        ]);
    }
}