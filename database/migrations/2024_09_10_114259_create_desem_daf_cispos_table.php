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
        Schema::create('desem_daf_cispos', function (Blueprint $table) {
            $table->id();
            $table->string('name_cispoc');
            $table->string('usuario');
            $table->decimal('valor', 10, 2); // Use decimal para valores monetários
            $table->text('comentario')->nullable(); // Permite comentários vazios
            $table->string('status')->default('PENDENTE'); // Adiciona o campo status
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
        Schema::dropIfExists('desem_daf_cispos');
    }
};