<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookupValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_lookup_list');
            $table->string('option_key', 191)->nullable();
            $table->string('option_value', 191);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('fk_parent_value')->nullable()->index('fk_parent_value');
            $table->boolean('has_children')->default(0);
            $table->softDeletes();
            $table->index(['fk_lookup_list', 'option_key'], 'un_lookup_list');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookup_values');
    }
}
