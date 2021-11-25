<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 200);
            $table->decimal("precio", 10, 2)->nullable();
            $table->integer("cantidad");
            $table->text("descripcion")->nullable();
            $table->string("imagen")->nullable(); 
            // 1:N
            $table->bigInteger("subcategoria_id")->unsigned();
            $table->foreign("subcategoria_id")->references("id")->on("subcategorias");          

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
