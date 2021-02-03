<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 32);
            $table->string('email', 64);
            $table->string('phone_number', 15)->nullable();
            $table->string('password', 128);
            $table->enum('level', ['pelanggan', 'produsen', 'admin', 'superadmin'])->default('pelanggan');
            $table->text('alamat')->nullable();
            $table->string('remember_token', 128)->nullable();
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
        Schema::dropIfExists('pengguna');
    }
}
