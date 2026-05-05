<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gambar_layanan', function (Blueprint $table) {
            $table->increments("id_gambar");
            $table->unsignedInteger("id_layanan")->nullable();
            $table->string("file_gambar", 255)->nullable();
            $table->foreign("id_layanan")->references("id_layanan")->on("layanan");
        });
    }

    public function down()
    {
        Schema::dropIfExists('gambar_layanan');
    }
};
