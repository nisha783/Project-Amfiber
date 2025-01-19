<?php

namespace App\Filament\Resources\InvioceResource\Pages;

use App\Filament\Resources\InvioceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvioce extends EditRecord
{
    protected static string $resource = InvioceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
