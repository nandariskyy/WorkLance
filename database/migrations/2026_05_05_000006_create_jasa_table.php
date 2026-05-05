<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jasa', function (Blueprint $table) {
            $table->increments("id_jasa");
            $table->unsignedInteger("id_kategori")->nullable();
            $table->string("nama_jasa", 100)->nullable();
            $table->foreign("id_kategori")->references("id_kategori")->on("kategori");
        });
    }

    public function down()
    {
        Schema::dropIfExists('jasa');
    }
};
