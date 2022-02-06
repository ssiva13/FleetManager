<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate_number', 191)->unique();
            $table->string('make', 191);
            $table->string('model', 191);
            $table->smallInteger('year_of_manufacture')->nullable();
            $table->string('transmission', 191)->nullable();
            $table->string('fuel', 191)->nullable();
            $table->string('engine_size', 191)->nullable();
            $table->string('color', 191)->nullable();
            $table->unsignedBigInteger('owner')->index('cars_owner_foreign');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
