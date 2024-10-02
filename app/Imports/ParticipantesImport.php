<?php

namespace App\Imports;

use App\Models\Participante;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantesImport
{
    public function import($filePath)
    {
        // Carregar o arquivo Excel
        Excel::load($filePath, function($reader) {

            // Iterar sobre cada linha do Excel
            $reader->each(function($row) {

                // Validação dos dados importados
                $validator = Validator::make($row->toArray(), [
                    'codigo' => ['required', 'string', 'max:255'],
                    'projecto_id' => ['required', 'integer'],
                ]);

                if ($validator->fails()) {
                    // Ignorar ou lidar com as linhas que falham na validação
                    return;
                }

                // Criar um novo participante
                Participante::create([
                    'codigo' => $row->codigo,
                    'projecto_id' => $row->projecto_id,
                ]);
            });

        });
    }
}
