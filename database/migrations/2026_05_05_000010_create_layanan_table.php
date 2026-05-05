<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->increments("id_layanan");
            $table->unsignedInteger("id_pengguna")->nullable();
            $table->unsignedInteger("id_jasa")->nullable();
            $table->unsignedInteger("id_satuan")->nullable();
            $table->integer("tarif")->nullable();
            $table->text("deskripsi")->nullable();
            $table->foreign("id_pengguna")->references("id_pengguna")->on("pengguna");
            $table->foreign("id_jasa")->references("id_jasa")->on("jasa");
            $table->foreign("id_satuan")->references("id_satuan")->on("satuan");
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan');
    }
};
