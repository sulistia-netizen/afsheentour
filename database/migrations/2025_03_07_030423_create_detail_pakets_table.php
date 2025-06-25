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
        Schema::create('detail_pakets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_paket");
            $table->string("jam_mulai");
            $table->string("jam_selesai");
            $table->unsignedBigInteger("id_destinasi");
            $table->integer("hari_ke")->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->unsignedBigInteger("deleted_by")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pakets');
    }
};
