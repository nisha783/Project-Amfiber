<x-filament::page>
    <form wire:submit.prevent="saveInvoice">
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Customer Selector -->
                <x-filament::form-field :label="__('Customer')" wire:model="customer_id">
                    <x-filament::select 
                        name="customer_id" 
                        options="{{ Party::all()->pluck('name', 'id') }}" 
                        wire:model="customer_id"
                    />
                </x-filament::form-field>

                <!-- Product & Plai Fields -->
                <x-filament::repeater wire:model="invoice_products">
                    <x-filament::repeater-item>
                        <x-filament::form-field :label="__('Product')">
                            <x-filament::select wire:model="product_id" :options="Product::all()->pluck('name', 'id')" />
                        </x-filament::form-field>

                        <x-filament::form-field :label="__('Plai')">
                            <x-filament::select wire:model="plai_id" :options="Plai::all()->pluck('name', 'id')" />
                        </x-filament::form-field>

                        <!-- Width and Height -->
                        <x-filament::form-field :label="__('Width (Feet & Inches)')">
                            <x-filament::input wire:model="width_in_feet" type="number" min="0" class="w-16" placeholder="Feet" />
                            <x-filament::input wire:model="width_in_inches" type="number" min="0" class="w-16" placeholder="Inches" />
                        </x-filament::form-field>

                        <x-filament::form-field :label="__('Height (Feet & Inches)')">
                            <x-filament::input wire:model="height_in_feet" type="number" min="0" class="w-16" placeholder="Feet" />
                            <x-filament::input wire:model="height_in_inches" type="number" min="0" class="w-16" placeholder="Inches" />
                        </x-filament::form-field>

                        <!-- Quantity & Price -->
                        <x-filament::form-field :label="__('Quantity')">
                            <x-filament::input wire:model="qty" type="number" min="1" class="w-full" />
                        </x-filament::form-field>

                        <x-filament::form-field :label="__('Price')">
                            <x-filament::input wire:model="price" type="number" min="0" class="w-full" />
                        </x-filament::form-field>
                    </x-filament::repeater-item>
                </x-filament::repeater>

                <!-- Discount -->
                <x-filament::form-field :label="__('Discount')">
                    <x-filament::input wire:model="discount" type="number" min="0" max="100" />
                </x-filament::form-field>

                <!-- Advance -->
                <x-filament::form-field :label="__('Advance Payment')">
                    <x-filament::input wire:model="advance" type="number" min="0" />
                </x-filament::form-field>
            </div>
        </div>

        <x-filament::button type="submit" class="mt-4">Create Invoice</x-filament::button>
    </form>
</x-filament::page>
