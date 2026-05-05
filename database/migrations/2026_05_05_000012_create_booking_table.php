<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments("id_booking");
            $table->unsignedInteger("id_pengguna")->nullable();
            $table->unsignedInteger("id_layanan")->nullable();
            $table->date("tanggal_booking")->nullable();
            $table->text("alamat_booking")->nullable();
            $table->text("catatan")->nullable();
            $table->enum("status_booking", ["MENUNGGU", "DIPROSES", "SELESAI", "DIBATALKAN"])->nullable();
            $table->foreign("id_pengguna")->references("id_pengguna")->on("pengguna");
            $table->foreign("id_layanan")->references("id_layanan")->on("layanan");
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking');
    }
};
