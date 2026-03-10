<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('estado')->nullable();
            $table->bigInteger('id_orden')->unsigned()->nullable();
            $table->foreign('id_orden')
            ->references('norden')
            ->on('orders');

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
        Schema::dropIfExists('view_orders');
    }
}
