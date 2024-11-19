<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeleksisTable extends Migration
{
    public function up(): void
    {
        Schema::create('seleksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftars')->onDelete('cascade'); // Relasi ke pendaftar
            $table->string('status')->default('lihat'); // Default status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seleksis');
    }
}
