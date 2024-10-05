<?php

namespace App\Filament\Resources\EvaluacionesResource\Pages;

use App\Filament\Resources\EvaluacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvaluaciones extends EditRecord
{
    protected static string $resource = EvaluacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
