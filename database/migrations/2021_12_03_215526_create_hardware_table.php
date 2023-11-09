<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHardwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware', function (Blueprint $table) {
            $table->string('serial')->primary();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
            ->references('id')
            ->on('customers');
            $table->string('tipo');//en este campo se especifica que tipo de hardware es o el tipo de dispositivo, pc de escritorio (torre), laptop, dispositivo movil (celular)
            $table->longtext('h_detalles');//detalles sobre el hardware entregado, tipo de procesador, etc.
            $table->string('marca');
            $table->string('modelo');
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
        Schema::dropIfExists('hardware');
    }
}
