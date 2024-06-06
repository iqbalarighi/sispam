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
        Schema::create('izin_validasi', function (Blueprint $table) {
            $table->id();
            $table->string('izin_id');
            $table->string('mulai_granted')->nullable();
            $table->string('sampai_granted')->nullable();
            $table->string('nm_pmhn_granted')->nullable();
            $table->date('tgl_pmhn_granted')->nullable();
            $table->string('nm_pmrks_granted')->nullable();
            $table->date('tgl_pmrks_granted')->nullable();
            $table->string('nm_pngws_granted')->nullable();
            $table->date('tgl_pngws_granted')->nullable();
            // $table->string('mulai_ovtme')->nullable();
            // $table->string('sampai_ovtme')->nullable();
            // $table->string('nm_pmhn_ovtme')->nullable();
            // $table->date('tgl_pmhn_ovtme')->nullable();
            // $table->string('nm_pmrks_ovtme')->nullable();
            // $table->date('tgl_pmrks_ovtme')->nullable();
            // $table->string('nm_pngws_ovtme')->nullable();
            // $table->date('tgl_pngws_ovtme')->nullable();
            $table->string('mulai_denied')->nullable();
            $table->string('sampai_denied')->nullable();
            $table->string('nm_pmhn_denied')->nullable();
            $table->date('tgl_pmhn_denied')->nullable();
            $table->string('nm_pmrks_denied')->nullable();
            $table->date('tgl_pmrks_denied')->nullable();
            $table->string('nm_pngws_denied')->nullable();
            $table->date('tgl_pngws_denied')->nullable();
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('izin_validasi');
    }
};
