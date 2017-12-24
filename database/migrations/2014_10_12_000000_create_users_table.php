<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('org_name');
            $table->string('name');
            $table->string('phone',10);
            $table->string('address');
            $table->string('city');
            $table->string('state',2);
            $table->string('zip',5);
            $table->string('website')->nullable();
            $table->string('org_type')->nullable();
            $table->string('billing_name');
            $table->string('billing_phone',10);
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_state',2);
            $table->string('billing_zip',5);
            $table->string('org_size');



            $table->rememberToken();

            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();

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
        Schema::dropIfExists('users');
    }
}
