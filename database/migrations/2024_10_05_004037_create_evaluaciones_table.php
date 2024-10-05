<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_site')->constrained('operaciones'); 
            $table->foreignId('id_users')->constrained('users'); 
            $table->date('date'); 
            $table->string('event_type'); 
            $table->date('opening_date'); 
            $table->string('event_status'); 
            $table->text('observations'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
}
