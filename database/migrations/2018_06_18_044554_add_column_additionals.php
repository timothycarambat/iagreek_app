<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAdditionals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('sign_requests', function (Blueprint $table) {
        $table->text('additionals')
        ->default(json_encode(
          ["one"=>null,
          "two"=>null,
          "three"=>null,
          "completed" => [],
          ]
          )
        );
      });
    }
}
