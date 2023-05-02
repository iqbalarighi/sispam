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
        Schema::create('kejadian', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kejadian');
            $table->string('lokasi_kejadian');
            $table->string('waktu_kejadian');
            $table->string('jam_kejadian');
            $table->string('tanggal_laporan');
            $table->string('jam_laporan');
            $table->string('jenis_potensi');
            $table->string('penyebab');
            $table->string('saksi_mata');
            $table->string('korban');
            $table->string('kerugian');
            $table->string('uraian_singkat');
            $table->string('sebab_tindakan');
            $table->string('sebab_kondisi');
            $table->string('sebab_dasar');
            $table->string('tindak_perbaikan');
            $table->string('rencana_perbaikan');
            $table->string('kom_mng_rep');
            $table->string('nama_pelapor');
            $table->string('uker_pelapor');
            $table->string('nama_penyidik');
            $table->string('uker_penyidik');
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
        Schema::dropIfExists('kejadian');
    }
};
