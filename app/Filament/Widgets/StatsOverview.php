<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Quotation; // Assuming Quotation model is available

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total Customers
           // Stat::make('Total Customers', Customer::count())  // Pass both label and value
           //     ->description('Total number of registered customers')
           //     ->icon('heroicon-o-user-group'),

            // Total Invoices
            Stat::make('Total Invoices', Invoice::count())  // Pass both label and value
                ->icon('heroicon-o-document-text'),

            // Total Quotations
            Stat::make('Total Quotations', Quotation::count())  // Pass both label and value
                ->icon('heroicon-o-document'),
        ];
    }
}
