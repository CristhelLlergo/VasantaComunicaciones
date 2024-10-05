<?php

namespace App\Filament\Resources\EvaluacionesResource\Pages;

use App\Filament\Resources\EvaluacionesResource;
use App\Models\Operaciones; 
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluaciones extends EditRecord
{
    protected static string $resource = EvaluacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
            // Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        
        $evaluacion = $this->record; 
        
        
        $operacion = Operaciones::find($evaluacion->id_site);
        if ($operacion) {
          
            $operacion->event_status = $evaluacion->event_status;
            $operacion->opening_date = $evaluacion->opening_date;
            $operacion->save(); 
        }
    }

    
    protected function saved(): void
    {
        $this->afterSave(); 
    }
}
