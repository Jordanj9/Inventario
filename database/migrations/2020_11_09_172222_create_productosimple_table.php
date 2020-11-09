<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosimpleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productosimple', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->float('costo');
            $table->float('precio')->default(0);
            $table->integer('cantidad')->default(0);
            $table->string('preparacion');
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
        Schema::dropIfExists('productosimple');
    }
}
