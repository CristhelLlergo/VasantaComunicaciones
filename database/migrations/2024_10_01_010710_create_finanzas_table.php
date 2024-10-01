<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finanzas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_site'); 
            $table->date('date'); 
            $table->string('movement'); 
            $table->string('movement_type'); 
            $table->decimal('amount', 10, 2); 
            $table->date('date_of_movement'); 
            $table->date('expiration_date'); 
            $table->string('status'); 
            $table->timestamps();

            // Foreign key con la tabla 'operaciones'
            $table->foreign('id_site')->references('id')->on('operaciones')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finanzas');
    }
};