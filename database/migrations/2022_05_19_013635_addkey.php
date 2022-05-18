<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addkey extends Migration
{
    public function up()
    {
        Schema::table('schemes', function (Blueprint $table) {
            $table->foreign('login')->references('name')->on('users');
        });
    }

    public function down()
    {
        Schema::table('schemes', function (Blueprint $table) {
            //
        });
    }
}
