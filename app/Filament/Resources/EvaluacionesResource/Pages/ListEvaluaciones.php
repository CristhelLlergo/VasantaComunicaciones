<?php

namespace App\Filament\Resources\EvaluacionesResource\Pages;

use App\Filament\Resources\EvaluacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvaluaciones extends ListRecords
{
    protected static string $resource = EvaluacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
