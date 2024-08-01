<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisTanamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('jenis_tanamans', function (Blueprint $table) {
            $table->id('id_jenis');
            $table->string('nama_jenis');
            $table->float('tmax_ph');
            $table->float('tmin_ph');
            $table->float('t_suhu');
            $table->float('t_cahaya');
            $table->float('tmax_ketinggian');
            $table->float('tmin_ketinggian');
            $table->float('t_kelembapan');
            $table->float('tmax_tds');
            $table->float('tmin_tds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_tanamans');
    }
}
