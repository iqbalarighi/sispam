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
        Schema::create('parkir', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('lantai', 50);
            $table->string('nip', 20)->unique();
            $table->string('nama', 100);
            $table->string('jabatan', 50);
            $table->integer('akses')->length(10)->unsigned();
            $table->integer('aktif')->length(10)->unsigned();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('parkir');
    }
};
