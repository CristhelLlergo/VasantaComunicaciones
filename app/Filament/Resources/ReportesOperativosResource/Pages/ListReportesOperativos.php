<?php

namespace App\Filament\Resources\ReportesOperativosResource\Pages;

use App\Filament\Resources\ReportesOperativosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportesOperativos extends ListRecords
{
    protected static string $resource = ReportesOperativosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
