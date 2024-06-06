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
        Schema::create('personil', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique()->length(100);
            $table->string('nama', 100);
            $table->string('foto_personil', 50)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('gender', 20);
            $table->string('pendidikan', 100)->nullable();
            $table->integer('lokasi_tugas')->length(10)->unsigned();
            $table->string('kd', 20)->nullable();
            $table->string('foto_kd', 50)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('norek', 20)->nullable();
            $table->string('bpjs_sehat', 25)->nullable();
            $table->string('foto_bpjss', 30)->nullable();
            $table->string('bpjs_kerja', 25)->nullable();
            $table->string('foto_bpjsk', 30)->nullable();
            $table->string('lama_kerja', 10)->nullable();
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
        Schema::dropIfExists('personil');
    }
};
