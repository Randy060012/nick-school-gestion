<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricule');
            $table->string('uid')->nullable();
            $table->string('name');
            $table->string('prenom');
            $table->string('date_naissance');
            $table->string('sexe');
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
         Schema::dropIfExists('students');
     }

}
