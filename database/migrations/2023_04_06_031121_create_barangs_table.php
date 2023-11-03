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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('idVariant')->constrained('variants')->onUpdate('cascade')->onDelete('restrict');
            $table->text('spesifikasi');
            $table->string('kode_barang')->unique();
            $table->date('tahun')->nullable();
            $table->boolean('isMove');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
