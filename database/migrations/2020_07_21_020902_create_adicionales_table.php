<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdicionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adicionales', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('compras_id')->nullable()->unsigned();
			$table->integer('rubros')->unsigned();
			$table->decimal('monto', 12,2)->nullable()->unsigned();
			$table->foreign('compras_id')->references('id')->on('compras')->onDelete('cascade');
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
        Schema::dropIfExists('adicionales');
    }
}
