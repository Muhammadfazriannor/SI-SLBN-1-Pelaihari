<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarsTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('foto')->nullable(); // Optional jika foto tidak diupload
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftars');
    }
}
