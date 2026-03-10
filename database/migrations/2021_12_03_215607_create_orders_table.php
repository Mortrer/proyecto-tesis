<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('norden');
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
            ->references('id')
            ->on('customers');

            $table->string('id_equipo');
            $table->foreign('id_equipo')
            ->references('serial')
            ->on('hardware');
            $table->string('estado')->nullable();//estado; en reparacion, reparado, entregado.
            $table->date('fecha_estimada');
            $table->date('fecha_egreso')->nullable();

            $table->bigInteger('id_costo')->unsigned()->nullable();
            $table->foreign('id_costo')
            ->references('id')
            ->on('costs');

            $table->longtext('comentarios');//comentarios sobre problema y estado del equipo entregado

            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')
            ->references('id')
            ->on('users');

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
        Schema::dropIfExists('orders');
    }
}
