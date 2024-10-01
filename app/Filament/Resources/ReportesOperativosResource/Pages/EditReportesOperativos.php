<?php

namespace App\Filament\Resources\ReportesOperativosResource\Pages;

use App\Filament\Resources\ReportesOperativosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportesOperativos extends EditRecord
{
    protected static string $resource = ReportesOperativosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
