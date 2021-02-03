<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKomposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('komposisi', function (Blueprint $table) {
            $table->foreign('id_bahan', 'komposisi_ibfk_1')->references('id')->on('bahan')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_pupuk', 'komposisi_ibfk_2')->references('id')->on('pupuk')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('komposisi', function (Blueprint $table) {
            $table->dropForeign('komposisi_ibfk_1');
            $table->dropForeign('komposisi_ibfk_2');
        });
    }
}
