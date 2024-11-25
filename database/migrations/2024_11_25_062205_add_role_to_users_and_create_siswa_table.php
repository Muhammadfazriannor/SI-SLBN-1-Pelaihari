<?php

public function up()
{
    // Tambahkan kolom 'role' ke tabel 'users'
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin', 'siswa'])->default('siswa')->after('password');
    });

    // Buat tabel 'siswa'
    Schema::create('siswa', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('kelas', 50);
        $table->date('tanggal_lahir');
        $table->text('alamat')->nullable();
        $table->timestamps();

        // Relasi ke tabel 'users'
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

