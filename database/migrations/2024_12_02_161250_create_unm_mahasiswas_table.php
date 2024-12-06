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
        Schema::create('unm_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masa_id');
            $table->string('nim', 9);
            $table->string('nama_mahasiswa',50);
            $table->string('kode_upbjj', 2);
            $table->string('nama_upbjj', 20);
            $table->string('hp', 20);
            $table->string('kode_program_studi', 4);
            $table->string('nama_program_studi', 20);
            $table->unsignedBigInteger('tempat_ujian_id');
            $table->unsignedBigInteger('lokasi_ujian_id');
            $table->string('ruang_ujian', 20)->nullable();
            $table->string('kode_mtk_11', 10)->nullable();
            $table->string('kode_mtk_12', 10)->nullable();
            $table->string('kode_mtk_13', 10)->nullable();
            $table->string('kode_mtk_14', 10)->nullable();
            $table->string('kode_mtk_15', 10)->nullable();
            $table->string('kode_mtk_21', 10)->nullable();
            $table->string('kode_mtk_22', 10)->nullable();
            $table->string('kode_mtk_23', 10)->nullable();
            $table->string('kode_mtk_24', 10)->nullable();
            $table->string('kode_mtk_25', 10)->nullable();
            $table->string('nama_mtk_11', 100)->nullable();
            $table->string('nama_mtk_12', 100)->nullable();
            $table->string('nama_mtk_13', 100)->nullable();
            $table->string('nama_mtk_14', 100)->nullable();
            $table->string('nama_mtk_15', 100)->nullable();
            $table->string('nama_mtk_21', 100)->nullable();
            $table->string('nama_mtk_22', 100)->nullable();
            $table->string('nama_mtk_23', 100)->nullable();
            $table->string('nama_mtk_24', 100)->nullable();
            $table->string('nama_mtk_25', 100)->nullable();
            $table->timestamps();

            $table->foreign('masa_id')->references('id')->on('masa')->onUpdate('cascade');
            $table->foreign('tempat_ujian_id')->references('id')->on('tempat_ujians')->onUpdate('cascade');
            $table->foreign('lokasi_ujian_id')->references('id')->on('lokasi_ujians')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unm_mahasiswas');
    }
};
