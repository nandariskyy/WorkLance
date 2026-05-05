<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provinsi', function (Blueprint $table) {
            $table->increments("id_provinsi");
            $table->string("nama_provinsi", 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('provinsi');
    }
};
