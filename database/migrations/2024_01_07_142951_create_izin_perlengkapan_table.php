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
        Schema::create('izin_perlengkapan', function (Blueprint $table) {
            $table->id();
            $table->string('izin_id');
            $table->text('alat')->nullable();
            $table->text('jml_alat')->nullable();
            $table->text('mesin')->nullable();
            $table->text('jml_mesin')->nullable();
            $table->text('material')->nullable();
            $table->text('jml_material')->nullable();
            $table->text('alat_berat')->nullable();
            $table->text('jml_alat_berat')->nullable();
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
        Schema::dropIfExists('izin_perlengkapan');
    }
};
