<?php

namespace App\Filament\Resources\OficioResource\Pages;

use App\Filament\Resources\OficioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOficio extends CreateRecord
{
    protected static string $resource = OficioResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        $data['status_oficios_id'] = 1;  // Pendiente

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
