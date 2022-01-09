<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_name', 191)->unique();
            $table->string('name_format', 191)->nullable();
            $table->string('data_type', 191);
            $table->boolean('required')->default(0);
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
        Schema::dropIfExists('lookup_lists');
    }
}
