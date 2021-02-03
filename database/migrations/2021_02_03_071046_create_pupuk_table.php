<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePupukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupuk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama', 64);
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            $table->integer('jumlah')->default(0);
            $table->string('gambar', 128)->nullable()->default('assets/images/tumbnail_pupuk.png');
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pupuk');
    }
}
