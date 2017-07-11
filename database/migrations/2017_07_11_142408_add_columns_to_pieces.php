<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPieces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pieces', function (Blueprint $table) {
            $table->integer('media_id')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->text('licences')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn('media_id');
        });
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
        Schema::table('pieces', function (Blueprint $table) {
            $table->dropColumn('licences');
        });
    }
}
