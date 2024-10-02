<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes_operativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_site');
            $table->string('event_type');
            $table->date('date');
            $table->string('pdf_document');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('nuevos_usuarios')->onDelete('cascade');
            $table->foreign('id_site')->references('id')->on('operaciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes_operativos');
    }
};
