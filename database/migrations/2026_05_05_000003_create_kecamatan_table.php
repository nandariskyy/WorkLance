<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->increments("id_kecamatan");
            $table->unsignedInteger("id_kabupaten")->nullable();
            $table->string("nama_kecamatan", 50)->nullable();
            $table->foreign("id_kabupaten")->references("id_kabupaten")->on("kabupaten");
        });
    }

    public function down()
    {
        Schema::dropIfExists('kecamatan');
    }
};
