<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailOnCampaignCompleteNotificationToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('users', function ($table) {
         $table->boolean('email_on_campaign_complete')->default(1);
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('users', function ($table) {
         $table->dropColumn('email_on_campaign_complete');
       });
     }
}
