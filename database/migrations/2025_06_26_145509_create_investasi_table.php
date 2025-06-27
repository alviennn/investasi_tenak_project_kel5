<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestasiTable extends Migration
{
    public function up()
    {
        Schema::create('investasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_investor')->constrained('investor')->onDelete('cascade'); // Relasi ke investor
            $table->foreignId('id_bank')->constrained('bank')->onDelete('cascade');  
            $table->foreignId('id_ternak')->constrained('ternaks')->onDelete('cascade');// Menyimpan ID bank yang berhubungan dengan tabel 'bank'
            $table->decimal('dana_investasi', 15, 2); // Jumlah investasi
            $table->date('tanggal_investasi');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investasi');
    }
}
