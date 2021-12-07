<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_receta', function (Blueprint $table) 
        {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('recetas', function (Blueprint $table) 
        {
            $table->id();
            $table->string('titulo');
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment('Relaciona al usuario que hace la receta');
            $table->foreignId('categoria_id')->references('id')->on('categorias_receta')->comment('Relaciona la categoria la receta');
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
        Schema::dropIfExists('categorias_receta');   
        Schema::dropIfExists('recetas');
    }
}
