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
        Schema::create('peralatan', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 20)->unique();
            $table->string('alat', 50);
            $table->string('satuan', 20)->nullable();
            $table->integer('jumlah')->length(20)->unsigned();
            $table->integer('gedung')->length(10)->unsigned();;
            $table->string('ruang', 100)->nullable();
            $table->string('milik', 50)->nullable();
            $table->string('kondisi', 50)->nullable();
            $table->text('riwayat')->nullable();
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
        Schema::dropIfExists('peralatan');
    }
};
