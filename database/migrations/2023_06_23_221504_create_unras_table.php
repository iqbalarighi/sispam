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
        Schema::create('unras', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal', 15);
            $table->string('waktu', 20);
            $table->string('tempat_kegiatan');
            $table->string('pelaksana');
            $table->string('bentuk_kegiatan', 30);
            $table->string('jumlah_massa', 20);
            $table->string('status_kegiatan', 20)->default('Rencana');
            $table->string('level_resiko', 20)->nullable();
            $table->string('sifat_kegiatan', 20)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('creator', 50);
            $table->string('editor', 50)->nullable();
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
        Schema::dropIfExists('unras');
    }
};
