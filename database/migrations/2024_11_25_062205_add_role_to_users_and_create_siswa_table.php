<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersAndCreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan kolom 'role' ke tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            // Pastikan kolom 'role' belum ada
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'siswa'])->default('siswa')->after('password');
            }
        });

        // Buat tabel 'siswa'
        if (!Schema::hasTable('siswa')) {
            Schema::create('siswa', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->unsignedBigInteger('user_id')->unique(); // Relasi ke tabel 'users'
                $table->string('kelas', 50); // Kelas siswa
                $table->date('tanggal_lahir'); // Tanggal lahir siswa
                $table->text('alamat')->nullable(); // Alamat siswa
                $table->timestamps(); // Timestamps

                // Relasi ke tabel 'users'
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus tabel 'siswa'
        if (Schema::hasTable('siswa')) {
            Schema::dropIfExists('siswa');
        }

        // Hapus kolom 'role' dari tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
}

