<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikanTable extends Migration
{
    public function up()
    {
        Schema::create('penarikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_investor')->constrained('investor')->onDelete('cascade');
            $table->foreignId('id_petani')->constrained('petani')->onDelete('cascade');
            // $table->foreignId('id_bank')->constrained('bank')->onDelete('cascade');
            // $table->string('nama_bank');
            // $table->string('nomor_rekening');
            $table->decimal('jumlah_penarikan', 15, 2);
            $table->date('tanggal');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penarikan');
    }
}