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
        Schema::create('referensi_jenis_tanaman', function (Blueprint $table) {
            $table->id('id_jenis_ref');
            $table->string('nama_jenis_ref');
            $table->float('tmax_ph_ref');
            $table->float('tmin_ph_ref');
            $table->float('t_suhu_ref');
            $table->float('t_cahaya_ref');
            $table->float('tmax_ketinggian_ref');
            $table->float('tmin_ketinggian_ref');
            $table->float('t_kelembapan_ref');
            $table->float('tmax_tds_ref');
            $table->float('tmin_tds_ref');
            $table->string('masa_tanam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensi_jenis_tanaman');
    }
};
