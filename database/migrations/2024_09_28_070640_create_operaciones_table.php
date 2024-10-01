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
        Schema::create('operaciones', function (Blueprint $table) {
            $table->string('site_name'); 
            $table->timestamp('registration_timestamp')->useCurrent(); 
            $table->string('event_type'); 
            $table->string('action'); 
            $table->unsignedBigInteger('id_users');
            $table->string('position'); 
            $table->date('opening_date'); 
            $table->date('closing_date')->nullable(); 
            $table->string('event_status'); 
            $table->timestamps();

            // esta linea de codigo es la relación con la tabla de Usuario 
            $table->foreign('id_users')->references('id')->on('nuevos_usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operaciones');
    }
};
