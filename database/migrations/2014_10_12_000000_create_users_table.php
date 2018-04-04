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
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('team')->unique();
            $table->string('participant1');
            $table->double('mobile_no1');
            $table->string('participant2')->nullable();
            $table->double('mobile_no2')->nullable();
            $table->tinyInteger('stage1')->default(0);
            $table->tinyInteger('stage2')->default(0);
            $table->tinyInteger('stage3')->default(0);
            $table->tinyInteger('stage4')->default(0);
            $table->timestamp('login_time')->nullable();
            $table->timestamp('stage1_time')->nullable();
            $table->timestamp('stage2_time')->nullable();
            $table->timestamp('stage3_time')->nullable();
            $table->timestamp('stage4_time')->nullable();
            $table->tinyInteger('stage1_attempts')->default(0);
            $table->tinyInteger('stage2_attempts')->default(0);
            $table->tinyInteger('stage3_attempts')->default(0);
            $table->tinyInteger('stage4_attempts')->default(0);
            $table->string('password');
            $table->rememberToken();
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
