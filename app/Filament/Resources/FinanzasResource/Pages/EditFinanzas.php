<?php

namespace App\Filament\Resources\FinanzasResource\Pages;

use App\Filament\Resources\FinanzasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFinanzas extends EditRecord
{
    protected static string $resource = FinanzasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
