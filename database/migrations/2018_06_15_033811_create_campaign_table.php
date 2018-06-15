<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('campaigns');
      Schema::create('campaigns', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->jsonb('data')->nullable();
        $table->timestamp('expiry')->nullable();
        $table->boolean('archived')->default(false);
        $table->integer('document_id');
        $table->integer('org_admin_id');

        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('campaigns');
    }
}
