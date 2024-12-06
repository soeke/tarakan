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
        Schema::create('jadwal_utms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masa_id');
            $table->string('h1',50);
            $table->string('h2',50);
            $table->timestamps();

            $table->foreign('masa_id')->references('id')->on('masa')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_utms');
    }
};
