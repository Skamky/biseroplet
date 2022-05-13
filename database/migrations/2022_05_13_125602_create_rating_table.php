<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->bigInteger('id_scheme');
            $table->boolean('value');
            $table->timestamps();
            //создание связи с таблицей users по полю id, по связанному полю user_id(в этой таблице)
           // $table->foreign('id_user')->references('id')->on('users');
           // $table->foreign('scheme_id')->references('id_scheme')->on('schemes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating');
    }
}
