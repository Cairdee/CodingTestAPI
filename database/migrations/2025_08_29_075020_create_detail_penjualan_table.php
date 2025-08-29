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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('nomer_penjualan');
            $table->unsignedBigInteger('produk_id');
            $table->integer('jml');
            $table->float('nominal');
            $table->timestamps();
            $table->foreign('nomer_penjualan')->references('nomer_penjualan')->on('head_penjualan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
