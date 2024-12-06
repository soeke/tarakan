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
        Schema::create('unm_mahasiswa_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masa_id');
            $table->unsignedBigInteger('unm_mahasiswa_id');
            $table->unsignedBigInteger('tempat_ujian_id');
            $table->string('kode_matakuliah');
            $table->string('jam_ujian')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=belum permintaan naskah, 1=sudah permintaan naskah');
            $table->timestamps();

            $table->foreign('masa_id')->references('id')->on('masa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unm_mahasiswa_id')->references('id')->on('unm_mahasiswas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tempat_ujian_id')->references('id')->on('tempat_ujians')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unm_mahasiswa_details');
    }
};
