<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('satuan', function (Blueprint $table) {
            $table->increments("id_satuan");
            $table->string("nama_satuan", 20)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('satuan');
    }
};
