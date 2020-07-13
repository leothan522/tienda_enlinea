<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('compras_id')->nullable()->unsigned();
            $table->bigInteger('ventas_id')->nullable()->unsigned();
            $table->bigInteger('productos_id')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->decimal('precio', 12,2)->nullable()->unsigned();
            $table->foreign('compras_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('ventas_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('carrito');
    }
}
