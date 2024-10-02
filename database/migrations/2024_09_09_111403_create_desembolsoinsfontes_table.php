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
        Schema::create('desembolsoinsfontes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fonte_id')->constrained('fontes'); // Chave estrangeira para a tabela fontes
            $table->foreignId('projecto_id')->constrained('projectos'); // Chave estrangeira para a tabela projectos
            $table->foreignId('daf_id')->constrained('gestaos'); // Chave estrangeira para a tabela gestaos
            $table->double('valor', 15, 2); // Valor do desembolso
            $table->date('data'); // Data do desembolso
            $table->enum('status', ['APROVADO', 'NAO APROVADO', 'PENDENTE']); // Campo de status
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
        Schema::dropIfExists('desembolsoinsfontes');
    }
};
