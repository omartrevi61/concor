<?php

namespace App\Filament\Resources\StatusOficioResource\Pages;

use App\Filament\Resources\StatusOficioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStatusOficios extends ManageRecords
{
    protected static string $resource = StatusOficioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
