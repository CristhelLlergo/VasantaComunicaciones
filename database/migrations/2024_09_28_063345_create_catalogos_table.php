<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalogos', function (Blueprint $table) {
            $table->id(); 
            $table->string('catalog_name'); 
            $table->unsignedBigInteger('id_users'); 
            $table->string('pdf_document'); 
            $table->timestamps();

            // esta linea de codigo es clave foránea apuntando a la tabla correcta
            $table->foreign('id_users')->references('id')->on('nuevos_usuarios')->onDelete('cascade'); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalogos');
    }
};
