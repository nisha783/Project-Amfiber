<x-filament::page>
    <form wire:submit.prevent="saveInvoice">
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Customer Selector -->
                <div>
                    <label for="customer_id" class="block text-sm font-medium text-gray-700">
                        {{ __('Customer') }}
                    </label>
                    <select id="customer_id" wire:model="customer_id" name="customer_id"
                        class="form-control mt-1 block w-full text-gray-800">
                        <option value="">{{ __('Select Customer') }}</option>
                        @foreach(App\Models\Party::all() as $party)
                            <option value="{{ $party->id }}">{{ $party->name }}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>

                <!-- Product & Plai Fields -->
                <div wire:sortable="updateOrder">
                    <div>
                        <label for="product_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Product') }}
                        </label>
                        <select id="product_id" wire:model="product_id" name="product_id"
                            class="form-control mt-1 block w-full text-gray-800">
                            <option value="">{{ __('Select Product') }}</option>
                            @foreach(App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="plai_id" class="block text-sm font-medium text-gray-700">
                            {{ __('Plai') }}
                        </label>
                        <select id="plai_id" wire:model="plai_id" name="plai_id"
                            class="form-control mt-1 block w-full text-gray-800">
                            <option value="">{{ __('Select Plai') }}</option>
                            @foreach(App\Models\Plai::all() as $plai)
                                <option value="{{ $plai->id }}">{{ $plai->name }}</option>
                            @endforeach
                        </select>
                        @error('plai_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Width and Height -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        {{ __('Width (Feet & Inches)') }}
                    </label>
                    <div class="grid grid-cols-2 gap-4 mt-1">
                        <input type="number" wire:model="width_in_feet" class="form-control text-gray-800"
                            placeholder="Feet" min="0">
                        <input type="number" wire:model="width_in_inches" class="form-control text-gray-800"
                            placeholder="Inches" min="0">
                    </div>
                    @error('width_in_feet')
                    <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    @error('width_in_inches')
                    <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        {{ __('Height (Feet & Inches)') }}
                    </label>
                    <div class="grid grid-cols-2 gap-4 mt-1">
                        <input type="number" wire:model="height_in_feet" class="form-control text-gray-800"
                            placeholder="Feet" min="0">
                        <input type="number" wire:model="height_in_inches" class="form-control text-gray-800"
                            placeholder="Inches" min="0">
                    </div>
                    @error('height_in_feet')
                    <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                    @error('height_in_inches')
                    <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
                </div>

                <!-- Quantity -->
                <div>
                    <label for="qty" class="block text-sm font-medium text-gray-700">
                        {{ __('Quantity') }}
                    </label>
                    <input type="number" wire:model="qty" id="qty" min="1"
                        class="form-control mt-1 block w-full text-gray-800">
                </div>
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">
                        {{ __('Price') }}
                    </label>
                    <input type="number" wire:model="price" id="price" min="0"
                        class="form-control mt-1 block w-full text-gray-800">
                </div>

                <!-- Discount -->
                <div>
                    <label for="discount" class="block text-sm font-medium text-gray-700">
                        {{ __('Discount') }}
                    </label>
                    <input type="number" wire:model="discount" id="discount" min="0" max="100"
                        class="form-control mt-1 block w-full text-gray-800">
                </div>

                <!-- Advance -->
                <div>
                    <label for="advance" class="block text-sm font-medium text-gray-700">
                        {{ __('Advance Payment') }}
                    </label>
                    <input type="number" wire:model="advance" id="advance" min="0"
                        class="form-control mt-1 block w-full text-gray-800">
                </div>
            </div>
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-yellow-500 text-white rounded">
            {{ __('Create Invoice') }}
        </button>
    </form>
</x-filament::page>