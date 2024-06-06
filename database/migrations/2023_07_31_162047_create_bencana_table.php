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
        Schema::create('bencana', function (Blueprint $table) {
            $table->id();
            $table->string('no_bencana');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('jenis_bencana');
            $table->string('nama_pelapor');
            $table->string('satker');
            $table->string('status', 15)->default('Open');
            $table->text('kejadian_bencana');
            $table->text('kronologi_bencana');
            $table->text('penanganan');
            $table->text('foto');
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
        Schema::dropIfExists('bencana');
    }
};
