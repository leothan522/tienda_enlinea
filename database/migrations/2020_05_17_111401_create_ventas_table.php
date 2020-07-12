<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->bigInteger('datos_id')->unsigned()->nullable();
            $table->integer('pedido')->nullable()->unsigned();
            $table->decimal('monto', 12,2)->nullable()->unsigned();
            $table->date('fecha');
            $table->string('referencia')->nullable()->unique();
            $table->integer('capture')->nullable();
            $table->string('factura')->nullable()->unique();
            $table->string('estatus')->nullable();
            $table->string('municipio');
            $table->string('responsable');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('datos_id')->references('id')->on('datos_personales')->onDelete('set null');
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
        Schema::dropIfExists('ventas');
    }
}
