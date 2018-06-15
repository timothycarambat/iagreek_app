<?php

use Illuminate\Database\Seeder;

use App\Document;

class DocumentSeeder extends Seeder
{

    public function run()
    {
      foreach(range(1,5) as $i) {
        Document::create([
          'name' => "Testing Template $i",
          'content' => "<h1>Input Data for testing $i</h1>",
          'org_admin_id' => 1,
        ]);
      }
    }
}
