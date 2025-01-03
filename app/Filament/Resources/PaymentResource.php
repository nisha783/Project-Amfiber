<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Models\Party; // Assuming Party is your Customer model
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Payment Management';
    protected static ?int $navigationSort= 5;
    protected static ?string $navigationLabel = 'Payments';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('party_id')
                ->label('Select Customer')
                ->options(Party::all()->pluck('name', 'id')) // Fetch names and IDs of the customers
                ->searchable()
                ->required(), // Make it required
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('Reduction')
                    ->required()
                    ->numeric(),
                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash',
                        'mobicash' => 'Mobicash',
                        'easypaisa' => 'Easy Paisa',
                        'bank' => 'Bank',
                    ])
                    ->required()
                    ->placeholder('Select Payment Method'),

                Forms\Components\Textarea::make('reference')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('party.name') // Use the relationship 'party' and its 'name' field
                ->label('Customer Name') // You can add a label to the column
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('reference')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
