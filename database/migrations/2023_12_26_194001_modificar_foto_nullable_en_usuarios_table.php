<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarFotoNullableEnUsuariosTable extends Migration
{
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            // Eliminamos la columna 'Foto'
            $table->dropColumn('Foto');
        });
    }
    
    public function down()
    {
        Schema::table('empleados', function (Blueprint $table) {
            // Si necesitas revertir la migración, puedes recrear la columna 'Foto' aquí
            // $table->string('Foto')->nullable();
        });
    }
    

}

