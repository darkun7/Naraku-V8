<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_lahan')->nullable()->index('id_lahan');
            $table->string('nama_pemesan', 128);
            $table->integer('id_pupuk')->index('id_pupuk');
            $table->integer('jumlah');
            $table->text('alamat')->nullable();
            $table->string('kontak', 15)->nullable();
            $table->enum('status', ['belum bayar', 'lunas', 'selesai', 'batal'])->nullable()->default('belum bayar');
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
        Schema::dropIfExists('pemesanan');
    }
}
