<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTernaksTable extends Migration
{
    public function up()
    {
        Schema::create('ternaks', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('id_petani'); // FOREIGN KEY
            // $table->foreignId('id_investasi')->constrained('investasi')->onDelete('cascade')->nullable();

            $table->string('nama', 255);
            $table->enum('jenis', ['ayam', 'sapi', 'kambing', 'bebek', 'ikan']);
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending');
            $table->string('lokasi', 255)->nullable();
            $table->text('deskripsi')->nullable();

            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint
            $table->foreign('id_petani')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ternaks');
    }
}
