<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pieces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('number')->unique();
            $table->string('name')->nullable();
            $table->string('size')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->text('licences')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
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
        Schema::dropIfExists('pieces');
    }
}
