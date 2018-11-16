<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->timestamps();
            $table->string("sku")->unique(); // identificador principal del dominio.
            $table->string("description")->nullable();// La descripcion puede o no ser descrita
            $table->float("price"); // money
            $table->enum("type",["Department","House","Land"] );  // Catalogo: Department,House,Land
            $table->enum("status", ["Sold","Separated","Available"]); // Catalogo: Sold,Available,Separated
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
