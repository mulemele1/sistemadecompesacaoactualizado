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
        Schema::create('desembolsodafs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daf_id')->constrained('gestaos'); // Chave estrangeira para a tabela gestao
            $table->foreignId('projecto_id')->constrained('projectos'); // Chave estrangeira para a tabela projectos
            $table->foreignId('administracao_id')->constrained('administracaos'); // Chave estrangeira para a tabela administracao
            $table->decimal('valor', 10, 2); // Campo VALOR
            $table->date('data'); // Campo DATA
            $table->enum('status', ['APROVADO', 'NAO APROVADO', 'PENDENTE']); // Atualização do campo STATUS

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
        Schema::dropIfExists('desembolsodafs');
    }
};