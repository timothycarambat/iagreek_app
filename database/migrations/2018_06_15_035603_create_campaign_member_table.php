<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_member', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('campaign_id')->unsigned();
          $table->integer('member_id')->unsigned();

          $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
          $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_member');
    }
}
