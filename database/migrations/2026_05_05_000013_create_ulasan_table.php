<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->increments("id_ulasan");
            $table->unsignedInteger("id_booking")->nullable();
            $table->unsignedInteger("id_pengguna")->nullable();
            $table->integer("rating")->nullable();
            $table->text("komentar")->nullable();
            $table->date("tanggal_ulasan")->nullable();
            $table->foreign("id_booking")->references("id_booking")->on("booking");
            $table->foreign("id_pengguna")->references("id_pengguna")->on("pengguna");
        });
    }

    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
};
