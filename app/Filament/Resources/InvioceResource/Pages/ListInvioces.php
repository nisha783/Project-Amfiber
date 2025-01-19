<?php

namespace App\Filament\Resources\InvioceResource\Pages;

use App\Filament\Resources\InvioceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvioces extends ListRecords
{
    protected static string $resource = InvioceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
