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
        Schema::create('projectos', function (Blueprint $table) {
            $table->id();
            
            $table->string('acronimo'); // Acrônimo do projeto
            $table->foreignId('fonte_id')->constrained('fontes'); // Chave estrangeira para a tabela fontes
            $table->double('valor_orcamental', 15, 2)->nullable(); // Valor orçamentário
            $table->double('valor_participante', 15, 2)->nullable(); // Valor por participante
            $table->decimal('valor_nao_programado', 10, 2)->nullable();
            $table->date('data_prevista_termino')->nullable(); // Data prevista de término do projeto
            $table->enum('status', ['ATIVO', 'INATIVO'])->default('ATIVO'); // Status do projeto
    
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
        Schema::dropIfExists('projectos');
    }
};
