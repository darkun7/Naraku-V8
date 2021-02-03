<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_setting', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->text('deskripsi');
            $table->text('deskripsi_naraku');
            $table->text('jumbotron_title')->nullable();
            $table->text('jumbotron_text')->nullable();
            $table->string('jumbotron_image')->nullable();
            $table->string('maps', 128)->nullable();
            $table->string('nomor_wa', 13);
            $table->string('instagram', 64);
            $table->tinyInteger('maintenance')->default(0);
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_setting');
    }
}
