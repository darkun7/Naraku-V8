<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lahan', function (Blueprint $table) {
            $table->foreign('id_tanaman', 'lahan_ibfk_1')->references('id')->on('tanaman')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_user', 'lahan_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lahan', function (Blueprint $table) {
            $table->dropForeign('lahan_ibfk_1');
            $table->dropForeign('lahan_ibfk_2');
        });
    }
}
