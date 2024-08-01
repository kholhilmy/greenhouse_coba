<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('greenhouses', function (Blueprint $table) {
            $table->id('id_greenhouse');
            $table->string('nama_greenhouse');
            $table->date('waktu_tanam');
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id');

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_tanamans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('greenhouses');
    }
};
