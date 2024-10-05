<?php

namespace App\Filament\Resources\EvaluacionesResource\Pages;

use App\Filament\Resources\EvaluacionesResource;
use App\Models\Operaciones; // Asegúrate de incluir el modelo
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvaluaciones extends CreateRecord
{
    protected static string $resource = EvaluacionesResource::class;

    protected function afterSave(): void
    {
        parent::afterSave(); 

       
        $evaluacion = $this->record;

       
        $operacion = Operaciones::find($evaluacion->id_site);
        if ($operacion) {
          
            $operacion->event_status = $evaluacion->event_status;
            $operacion->opening_date = $evaluacion->opening_date;
            $operacion->save(); 
        }
    }
}


