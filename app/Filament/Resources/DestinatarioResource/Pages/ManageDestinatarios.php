<?php

namespace App\Filament\Resources\DestinatarioResource\Pages;

use App\Filament\Resources\DestinatarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDestinatarios extends ManageRecords
{
    protected static string $resource = DestinatarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
