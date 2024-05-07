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
        Schema::create('izinvendor', function (Blueprint $table) {
            $table->id();
            $table->string('izin_id');
            $table->string('klasifikasi');
            $table->string('no_dok');
            $table->string('biaya');
            $table->string('status')->default('open');
            $table->string('otorizedby', 50)->nullable();
            $table->string('validatedby', 50)->nullable();
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
        Schema::dropIfExists('izinvendor');
    }
};
