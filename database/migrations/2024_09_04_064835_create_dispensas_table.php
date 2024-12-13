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
        Schema::create('dispensas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recepcao_id')->constrained('recepcaos');
            $table->foreignId('projecto_id');
            $table->foreignId('participante_id');
            $table->string('visita')->nullable();;
            $table->double('valor_variavel', 15, 2)->nullable(); // ou o tipo correto;
            $table->double('valor', 15, 2)->nullable();
            $table->string('motivo')->nullable();;
            $table->double('valor_esp', 15, 2)->nullable();
            $table->string('motivo_esp')->nullable();
            $table->date('data_visita')->nullable();
            $table->string('user_name')->nullable();
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
        Schema::dropIfExists('dispensas');
    }
};
