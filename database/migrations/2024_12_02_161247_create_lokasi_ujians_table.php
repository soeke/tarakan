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
        Schema::create('lokasi_ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tempat_ujian_id');
            $table->unsignedBigInteger('masa_id');
            $table->string('nama_lokasi_ujian');
            $table->string('alamat_lokasi_ujian')->nullable();
            $table->boolean('status_numpang',['1','0'])->default('1');

            $table->foreign('tempat_ujian_id')->references('id')->on('tempat_ujians')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('masa_id')->references('id')->on('masa')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_ujians');
    }
};
