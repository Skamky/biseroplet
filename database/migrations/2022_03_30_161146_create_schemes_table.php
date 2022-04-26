<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schemes', function (Blueprint $table) {

            $table->id("id_scheme");
            $table -> string("login");
            $table -> string("name_scheme");
            $table -> text("description_scheme")->nullable();;
            $table -> string("color_scheme");
            $table ->longText("code_scheme");
            $table ->boolean("public")->default(false);
            $table->  timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schemes');
    }
}
