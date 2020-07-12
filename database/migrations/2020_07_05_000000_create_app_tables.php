<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('estados', function(Blueprint $table) {
		    $table->engine = 'InnoDB';

		    $table->integer('id_estado');
		    $table->string('estado', 128);

		    $table->primary('id_estado');

		    //$table->timestamps();

		});

		Schema::create('municipios', function(Blueprint $table) {
		    $table->engine = 'InnoDB';

		    $table->integer('id_municipio');
		    $table->integer('id_estado');
		    $table->string('municipio', 128);

		    $table->primary('id_municipio');

		    $table->index('id_estado','id_estado');

		    //$table->timestamps();

		});

		Schema::create('parroquias', function(Blueprint $table) {
		    $table->engine = 'InnoDB';

		    $table->integer('id_parroquia');
		    $table->integer('id_estado');
		    $table->integer('id_municipio');
		    $table->string('parroquia', 128);

		    $table->primary('id_parroquia');

		    $table->index('id_estado','id_estado');
		    $table->index('id_municipio','id_municipio');

		    //$table->timestamps();

		});

		Schema::create('centros_cne', function(Blueprint $table) {
		    $table->engine = 'InnoDB';

		    $table->integer('id_centro_cne');
		    $table->integer('id_parroquia')->default(null);
		    $table->string('nombre_centro', 128);
		    $table->string('direccion_centro', 256);

		    $table->primary('id_centro_cne');

		    $table->index('id_parroquia','id_parroquia');

		    //$table->timestamps();

		});

		Schema::create('registro_civil', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
			$table->id();
		    //$table->string('rif', 10)->default('');
		    $table->string('nacionalidad', 1);
		    $table->integer('cedula');
		    $table->string('primer_apellido', 128);
		    $table->string('segundo_apellido', 128)->default(null);
		    $table->string('primer_nombre', 128);
		    $table->string('segundo_nombre', 128)->default(null);
		    $table->integer('id_centro_cne')->default(null);

		    //$table->primary('rif');

		    //$table->index('nacionalidad','nacionalidad');
		    //$table->index('cedula','cedula');

		    //$table->timestamps();

		});


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('registro_civil');
		Schema::drop('centros_cne');
		Schema::drop('parroquias');
		Schema::drop('municipios');
		Schema::drop('estados');

    }
}
