<?php

namespace App\Filament\Resources\OperacionesResource\Pages;

use App\Filament\Resources\OperacionesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOperaciones extends EditRecord
{
    protected static string $resource = OperacionesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
