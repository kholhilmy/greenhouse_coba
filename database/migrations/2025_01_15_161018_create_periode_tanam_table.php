<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('periode_tanam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_greenhouse'); // Relasi ke tabel greenhouses
            $table->date('tanggal_tanam');
            $table->date('tanggal_panen')->nullable(); // Bisa nullable jika tanggal panen belum diketahui
            $table->text('keterangan')->nullable(); // Opsional untuk catatan tambahan
            $table->timestamps();

            // Foreign key untuk relasi dengan tabel greenhouses
            $table->foreign('id_greenhouse')->references('id_greenhouse')->on('greenhouses')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_tanam');
    }
};
