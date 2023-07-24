<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posjaga', function (Blueprint $table) {
            $table->id();
            $table->string('id_jaga', 20)->unique();
            $table->string('pos_jaga', 100);
            $table->string('gedung', 30);
            $table->string('area_jaga', 50);
            $table->string('kategori_ring', 20)->nullable();
            $table->string('personil_jaga', 100);
            $table->string('standar_peralatan', 150);
            $table->string('foto', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posjaga');
    }
};
