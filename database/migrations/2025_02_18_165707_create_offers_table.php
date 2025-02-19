<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('tipo_oferta');
            $table->string('codigo_cupon')->nullable();
            $table->string('cadena');
            $table->string('provincia');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('precio_original', 8, 2);
            $table->decimal('precio_descuento', 8, 2);
            $table->string('enlace');
            $table->string('usuario');
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
        Schema::dropIfExists('offers');
    }
}