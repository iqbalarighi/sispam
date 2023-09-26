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
        Schema::create('smc', function (Blueprint $table) {
            $table->id();
            $table->string('no_lap', 20)->unique();
            $table->string('tanggal', 10);
            $table->integer('gedung')->default(11);
            $table->string('shift', 50);
            $table->string('creator');
            $table->text('petugas');
            $table->text('giat');
            $table->text('keterangan')->nullable();
            $table->text('foto')->nullable();
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
        Schema::dropIfExists('smc');
    }
};