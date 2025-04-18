<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontakTable extends Migration
{
    public function up()
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id(); // id auto increment
            $table->string('nama'); // nama kontak
            $table->string('nomor_hp'); // nomor HP
            $table->string('email')->nullable(); // email opsional
            $table->text('alamat')->nullable(); // alamat opsional
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('kontak');
    }
}
