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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('layanan_id',20);
            $table->string('layanan',50);
            $table->datetime('tanggal');
            $table->text('detail_kebutuhan');
            $table->string('pic',50);
            $table->string('kontak',18);
            $table->string('email',50);
            $table->text('foto')->nullable();
            $table->string('status',20)->default('Open');
            $table->string('puas_layanan')->nullable();
            $table->string('puas_perilaku')->nullable();
            $table->text('masukan')->nullable();
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
        Schema::dropIfExists('layanan');
    }
};
