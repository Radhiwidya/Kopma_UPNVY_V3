<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_arsip')->nullable();

            $table->string('judul');

            $table->text('link');

            $table->string('bidang');

            $table->enum('status', ['public', 'privat'])
                  ->default('public');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};