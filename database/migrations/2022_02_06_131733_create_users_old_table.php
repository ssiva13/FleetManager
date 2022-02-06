<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersOldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_old', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 191);
            $table->string('middle_name', 191)->nullable();
            $table->string('last_name', 191);
            $table->string('email', 191)->unique('users_email_unique');
            $table->string('mobile', 191)->unique('users_mobile_unique');
            $table->string('telephone', 191)->unique('users_telephone_unique');
            $table->smallInteger('user_type')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('drivers_licence')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_old');
    }
}
