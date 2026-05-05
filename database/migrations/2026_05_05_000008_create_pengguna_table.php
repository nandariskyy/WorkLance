<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->increments("id_pengguna");
            $table->unsignedInteger("id_role")->nullable();
            $table->string("username", 50)->nullable()->unique();
            $table->string("nama_pengguna", 100)->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->string("no_telp", 20)->nullable();
            $table->string("email", 50)->nullable();
            $table->string("password", 255)->nullable();
            $table->unsignedInteger("id_provinsi")->nullable();
            $table->unsignedInteger("id_kabupaten")->nullable();
            $table->unsignedInteger("id_kecamatan")->nullable();
            $table->unsignedInteger("id_desa")->nullable();
            $table->text("alamat_lengkap")->nullable();
            $table->string("foto_profil", 255)->nullable();
            $table->foreign("id_role")->references("id_role")->on("role");
            $table->foreign("id_desa")->references("id_desa")->on("desa");
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
};
