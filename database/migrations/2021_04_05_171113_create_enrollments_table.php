<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('email', 200);
            $table->string('rol', 100);
            $table->enum('state', [
               'Desmatriculado', 'Matrículado', 'Cancelada','Finalizada','Retirado'
            ])->default('Matrículado');
            $table->foreign('email')->references('email')->on('students');
            $table->foreign('code')->references('code')->on('groups');
            $table->unique(['code', 'email']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollment');
    }
}