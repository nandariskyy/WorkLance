<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->increments("id_desa");
            $table->unsignedInteger("id_kecamatan")->nullable();
            $table->string("nama_desa", 50)->nullable();
            $table->foreign("id_kecamatan")->references("id_kecamatan")->on("kecamatan");
        });
    }

    public function down()
    {
        Schema::dropIfExists('desa');
    }
};
