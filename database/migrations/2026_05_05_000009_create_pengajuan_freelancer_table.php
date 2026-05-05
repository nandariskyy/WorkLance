<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_freelancer', function (Blueprint $table) {
            $table->increments("id_pengajuan");
            $table->unsignedInteger("id_pengguna")->nullable();
            $table->string("nik", 20)->nullable();
            $table->text("deskripsi")->nullable();
            $table->enum("status", ["MENUNGGU", "DITERIMA", "DITOLAK"])->default("MENUNGGU");
            $table->text("catatan_admin")->nullable();
            $table->dateTime("tanggal_pengajuan")->useCurrent();
            $table->foreign("id_pengguna")->references("id_pengguna")->on("pengguna");
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_freelancer');
    }
};
