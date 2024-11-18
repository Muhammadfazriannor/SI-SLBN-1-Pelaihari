<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeleksisTable extends Migration
{
    public function up()
    {
        Schema::create('seleksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('foto')->nullable(); // Kolom foto
            $table->boolean('lolos')->default(false); // Status seleksi
            $table->string('status')->default('lihat'); // Kolom status seleksi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seleksis');
    }
}
