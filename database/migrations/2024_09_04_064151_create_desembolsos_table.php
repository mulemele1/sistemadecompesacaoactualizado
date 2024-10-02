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
        Schema::create('desembolsos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gerencia_id')->constrained('gerencias'); // Chave estrangeira para a tabela administracao
            $table->foreignId('projecto_id')->constrained('projectos'); // Chave estrangeira para a tabela projectos
            $table->foreignId('administracao_id')->constrained('administracaos'); // Chave estrangeira para a tabela gestao
            $table->double('valor', 15, 2); // Valor do desembolso
            $table->date('data_desem'); // Data do desembolso
            $table->enum('status', ['APROVADO', 'NAO APROVADO', 'PENDENTE']); // Nova coluna status

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
        Schema::dropIfExists('desembolsos');
    }
};