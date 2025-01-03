<?php

namespace App\Filament\Pages;

use App\Models\Product;
use App\Models\Plai;
use App\Models\Party;  // Assuming `Party` is your customer model
use App\Models\Invoice;
use App\Models\InvoiceProduct;  // Make sure this model is correctly set up for the invoice products.
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class CreateInvoice extends Page
{
    protected static string $view = 'filament.pages.create-invoice';

    public $customer_id;
    public $invoice_products = [];
    public $discount;
    public $advance;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 4;
    protected static ?string $title = 'Create Invoice';

    // Initialize the page with default values or necessary setup
    public function mount(): void
    {
        $this->discount = 0;
        $this->advance = 0;
    }

    // Define form schema using Filament's form components
    protected function getFormSchema(): array
    {
        return [
           Select ::make('customer_id')
                ->label('Customer')
                ->options(Party::all()->pluck('name', 'id'))  // Assuming Party is the model for customers
                ->required()
                ->searchable(),

            Repeater::make('invoice_products')
                ->label('Invoice Products')
                ->schema([
                    Select::make('product_id')
                        ->label('Product')
                        ->options(Product::all()->pluck('name', 'id'))
                        ->required()
                        ->searchable(),
                    
                    Select::make('plai_id')
                        ->label('Plai')
                        ->options(Plai::all()->pluck('name', 'id'))
                        ->required()
                        ->searchable(),

                    TextInput::make('qty')
                        ->label('Quantity')
                        ->numeric()
                        ->required(),

                    TextInput::make('width_in_feet')
                        ->label('Width (Feet)')
                        ->numeric()
                        ->required(),
                    
                    TextInput::make('width_in_inches')
                        ->label('Width (Inches)')
                        ->numeric()
                        ->required(),

                    TextInput::make('height_in_feet')
                        ->label('Height (Feet)')
                        ->numeric()
                        ->required(),

                    TextInput::make('height_in_inches')
                        ->label('Height (Inches)')
                        ->numeric()
                        ->required(),

                    TextInput::make('price')
                        ->label('Price (Per Unit/SqFt)')
                        ->numeric()
                        ->required(),
                ])
                ->columns(2),

            TextInput::make('discount')
                ->label('Discount')
                ->numeric()
                ->default(0)
                ->minValue(0)
                ->maxValue(100),

            TextInput::make('advance')
                ->label('Advance Payment')
                ->numeric()
                ->default(0),
        ];
    }

    // Save the data entered by the user
    public function saveInvoice()
    {
        // Validate the form inputs before proceeding
        $validated = $this->validate();

        // Create the invoice entry
        $invoice = Invoice::create([
            'customer_id' => $this->customer_id,
            'discount' => $this->discount,
            'advance' => $this->advance,
        ]);

        // Save the invoice products (looping through each product item entered)
        foreach ($this->invoice_products as $product_data) {
            $total_price = $product_data['price'] * $product_data['qty']; // Calculate total price (e.g., width * height, qty, and price)

            InvoiceProduct::create([
                'invoice_id' => $invoice->id,  // Link this product to the current invoice
                'product_id' => $product_data['product_id'],
                'plai_id' => $product_data['plai_id'],
                'qty' => $product_data['qty'],
                'width_in_feet' => $product_data['width_in_feet'],
                'width_in_inches' => $product_data['width_in_inches'],
                'height_in_feet' => $product_data['height_in_feet'],
                'height_in_inches' => $product_data['height_in_inches'],
                'price' => $product_data['price'],
            ]);
        }

        // Add logic for showing messages after saving or redirecting to another page
        session()->flash('message', 'Invoice Created Successfully!');
    }
}
