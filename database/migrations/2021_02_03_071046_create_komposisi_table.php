<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komposisi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_pupuk')->index('id_pupuk');
            $table->integer('id_bahan')->index('id_bahan');
            $table->float('rasio', 10, 0);
            $table->enum('satuan', ['kwintal', 'kg', 'g', 'L', 'mL'])->nullable();
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
        Schema::dropIfExists('komposisi');
    }
}
