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
        Schema::create('izin_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('izin_id');
            $table->string('pekerjaan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('area')->nullable();
            $table->string('plant')->nullable();
            $table->string('manager')->nullable();
            $table->string('pemohon')->nullable();
            $table->string('tel_pemohon')->nullable();
            $table->string('pengawas')->nullable();
            $table->string('tel_pengawas')->nullable();
            $table->string('k3')->nullable();
            $table->string('tel_k3')->nullable();
            $table->string('perusahaan_pemohon')->nullable();
            $table->integer('pekerja')->nullable();
            $table->integer('enginer')->nullable();
            $table->integer('surveyor')->nullable();
            $table->integer('operator_alat')->nullable();
            $table->integer('rigger')->nullable();
            $table->integer('teknisi_elektrik')->nullable();
            $table->integer('mekanik')->nullable();
            $table->integer('welder')->nullable();
            $table->integer('fitter')->nullable();
            $table->integer('tukang_bangunan')->nullable();
            $table->integer('tukang_kayu')->nullable();
            $table->integer('lainnya')->nullable();
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
        Schema::dropIfExists('izin_informasi');
    }
};
