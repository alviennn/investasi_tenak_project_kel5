<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorTable extends Migration
{
    public function up()
    {
        Schema::create('investor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nik', 30)->nullable();
            $table->foreignId('id_bank')->nullable()->constrained('bank')->onDelete('cascade')->change();
            $table->integer('saldo')->default(0)->nullable();
            $table->timestamps();
        }); 
    }

    public function down()
    {
        Schema::dropIfExists('investor');
    }
}
