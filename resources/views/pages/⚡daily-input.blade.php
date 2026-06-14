<?php

use Livewire\Component;

new class extends Component
{
    public $date;

    public $quantity;
    public $price;

    public $search = '';

    public $productId = null;
    #[\Livewire\Attributes\Computed]
    public function products() {
        return \App\Models\Product::query()
            ->when($this->search, fn($query) => $query->where('description', 'like', '%' . $this->search . '%'))
            ->limit(20)
            ->get();
    }
    public function save()
    {
        $daily_input = new \App\Models\DailyInput();
        $daily_input['date'] = $this->date;
        $daily_input['user_id'] = 1;
        $daily_input['product_id'] = $this->productId;
        $daily_input['qty'] = $this->quantity;
        $daily_input['price'] = $this->price;
        $daily_input->save();
        $this->reset();


    }
};
?>

<div class="flex justify-center items-start min-h-screen py-8">
    <div class="w-full max-w-2xl">
        <!-- هدر -->
        <div class="mb-6 w-full">
            <flux:heading size="xl" level="1" class="mb-3 text-center">
                {{ __('ورود به انبار روزانه') }}
            </flux:heading>
            <flux:separator variant="subtle" />
        </div>

        <!-- فرم -->
        <div class="space-y-4">
            <!-- انتخاب تاریخ -->
            <flux:date-picker
                locale="fa-IR"
                wire:model="date"
                with-today
                selectable-header
                class="w-full"
            />

            <!-- انتخاب محصول -->
            <flux:select
                wire:model="productId"
                variant="combobox"
                :filter="false"
                class="w-full"
            >
                <x-slot name="input">
                    <flux:select.input wire:model.live="search" />
                </x-slot>

                @foreach ($this->products as $product)
                    <flux:select.option
                        value="{{ $product->id }}"
                        wire:key="{{ $product->id }}"
                    >
                        {{ $product->Description }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <!-- فیلدهای تعداد و قیمت -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:input
                    wire:model="quantity"
                    label="تعداد"
                    type="number"
                    min="0"
                    class="w-full"
                />

                <flux:input
                    wire:model="price"
                    label="قیمت"
                    type="number"
                    min="0"
                    step="0.01"
                    class="w-full"
                />
            </div>

            <!-- دکمه ذخیره -->
            <div class="mt-6 flex justify-center">
                <flux:button
                    variant="primary"
                    color="amber"
                    wire:click="save"
                    class="w-full sm:w-auto px-8"
                >
                    ذخیره
                </flux:button>
            </div>
        </div>
    </div>
</div>
