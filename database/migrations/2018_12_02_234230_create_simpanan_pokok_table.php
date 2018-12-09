<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSimpananPokokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan_pokok', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('jumlah', '12', '0');
            $table->char('bulan', '2');
            $table->year('tahun');
            $table->date('tanggal');
            $table->unsignedInteger('anggota_id');
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
        Schema::dropIfExists('simpanan_pokok');
    }
}
