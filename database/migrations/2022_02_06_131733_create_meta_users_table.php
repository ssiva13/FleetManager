<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_user')->index('meta_user_FK')->comment('User ID');
            $table->string('first_name', 191);
            $table->string('middle_name', 191)->nullable();
            $table->string('last_name', 191);
            $table->string('mobile', 191)->unique('users_mobile_unique');
            $table->string('telephone', 191)->unique('users_telephone_unique');
            $table->smallInteger('user_type')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('drivers_licence')->nullable();
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
        Schema::dropIfExists('meta_users');
    }
}
