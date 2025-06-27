<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPertumbuhanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_pertumbuhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_petani')
                ->constrained('petani')
                ->onDelete('cascade');
            $table->foreignId('id_ternaks')
                ->constrained('ternaks')
                ->onDelete('cascade');
            $table->string('nama', 100);
            $table->enum('jenis', ['ayam', 'sapi', 'kambing', 'bebek', 'ikan']);
            $table->dateTime('tanggal_laporan');
            $table->string('berat_rerata', 50);
            $table->decimal('pertumbuhan_persen', 5, 2);
            $table->enum('status', ['Excellent', 'Good', 'Average', 'Poor']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_pertumbuhan');
    }
}