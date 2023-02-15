<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string("detalle");
            $table->boolean("estado")->default(true);
            $table->text("observaciones")->default("SIN OBSERVACIONES");
            
            $table->bigInteger("pedido_id")->unsigned();
            $table->foreign("pedido_id")->references("id")->on("pedidos");
            
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
        Schema::dropIfExists('notas');
    }
};
