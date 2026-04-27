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
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_anggota');
            $table->integer('2016')->nullable()->default(0);
            $table->integer('2017')->nullable()->default(0);
            $table->integer('2018')->nullable()->default(0);
            $table->integer('2019')->nullable()->default(0);
            $table->integer('2020')->nullable()->default(0);
            $table->integer('2021')->nullable()->default(0);
            $table->integer('2022')->nullable()->default(0);
            $table->integer('2023')->nullable()->default(0);
            $table->integer('2024')->nullable()->default(0);
            $table->integer('2025')->nullable()->default(0);
            $table->integer('2026')->nullable()->default(0);
            $table->integer('2027')->nullable()->default(0);
            $table->integer('2028')->nullable()->default(0);
            $table->integer('2029')->nullable()->default(0);
            $table->integer('2030')->nullable()->default(0);
            $table->integer('2031')->nullable()->default(0);
            $table->integer('2032')->nullable()->default(0);
            $table->integer('2033')->nullable()->default(0);
            $table->integer('2034')->nullable()->default(0);
            $table->integer('2035')->nullable()->default(0);
            $table->integer('sp')->nullable()->default(0);
            $table->integer('ss')->nullable()->default(0);
            $table->integer('shu')->nullable()->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};
