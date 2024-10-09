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
        Schema::table('kejadian', function (Blueprint $table) {
            $table->string('validatedby')->nullable()->after('dokumentasi');
            $table->string('otorizedby')->nullable()->after('dokumentasi');
            $table->string('validatime')->nullable()->after('dokumentasi');
            $table->string('otoritime')->nullable()->after('dokumentasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kejadian', function (Blueprint $table) {
            $table->dropColumn('validatedby');
            $table->dropColumn('otorizedby');
            $table->dropColumn('validatime');
            $table->dropColumn('otoritime');
        });
    }
};
