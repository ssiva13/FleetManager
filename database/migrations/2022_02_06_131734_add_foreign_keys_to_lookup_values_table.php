<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLookupValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lookup_values', function (Blueprint $table) {
            $table->foreign('fk_lookup_list', 'fk_lookup_list')->references('id')->on('lookup_lists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('fk_parent_value', 'fk_parent_value')->references('id')->on('lookup_values')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lookup_values', function (Blueprint $table) {
            $table->dropForeign('fk_lookup_list');
            $table->dropForeign('fk_parent_value');
        });
    }
}
