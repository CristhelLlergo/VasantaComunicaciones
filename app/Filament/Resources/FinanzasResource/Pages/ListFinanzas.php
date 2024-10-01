<?php

namespace App\Filament\Resources\FinanzasResource\Pages;

use App\Filament\Resources\FinanzasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinanzas extends ListRecords
{
    protected static string $resource = FinanzasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
