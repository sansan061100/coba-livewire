<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- text product left and button right  --}}
        <div class="flex justify-between pb-5">
            <div class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product') }}
            </div>
            <div class="flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="create"
                    wire:loading.attr="disabled" type="button">
                    {{ __('Add New Product') }}
                </button>
                {{-- @if ($isOpen)
                    @include('livewire.product.modal')
                @endif --}}
            </div>
        </div>
        @include('livewire.product.modal')
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
            <livewire:product.product-table />
        </div>
    </div>
</div>
