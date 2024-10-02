<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('numero_prop')->unique(); // Número da proposta, deve ser único
            $table->string('descricao')->default('Valor de compesação'); // Descrição padrão
            $table->foreignId('projecto_id')->constrained('projectos'); // Chave estrangeira para a tabela projectos
            $table->double('valor_requisicao', 15, 2); // Valor da requisição
            $table->date('data_prop'); // Data da proposta
            $table->enum('status', ['Pendente', 'Nao aprovada', 'Aprovada'])->default('Pendente'); // Status da proposta
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propostas');
    }
};