<?php

namespace App\Filament\Resources\RemitenteResource\Pages;

use App\Filament\Resources\RemitenteResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRemitentes extends ManageRecords
{
    protected static string $resource = RemitenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
