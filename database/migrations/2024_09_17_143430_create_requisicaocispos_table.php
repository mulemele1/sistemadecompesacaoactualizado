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
        Schema::create('requisicaocispos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gerencia_id')->constrained('gerencias');
            $table->foreignId('projecto_id')->constrained('projectos');
            $table->foreignId('administracao_id')->constrained('administracaos');
            $table->double('valor', 15, 2);
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
        Schema::dropIfExists('requisicaocispos');
    }
};
