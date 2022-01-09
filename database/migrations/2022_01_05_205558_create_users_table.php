<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 191);
            $table->string('middle_name', 191)->nullable();
            $table->string('last_name', 191);
            $table->string('email', 191)->unique();
            $table->string('mobile', 191)->unique();
            $table->string('telephone', 191)->unique();
            $table->smallInteger('user_type')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('drivers_licence')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
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
