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
        Schema::create('contracheques', function (Blueprint $table) {
            $table->id();
            $table->string('anexo');
            $table->boolean('visualizado')->default(0);
            $table->unsignedBigInteger('funcionario_id');
            $table->integer('mes_referencia');
            $table->year('ano_referencia');
            $table->foreign('funcionario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracheques');
    }
};
