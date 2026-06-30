<?php

use App\Models\Customer;
use Livewire\Component;

new class extends Component {
    public Customer $customer;


    public $quantity;

    public $search = '';
    public $productId = null;

    #[\Livewire\Attributes\Computed]
    public function products()
    {
        return \App\Models\Product::query()
            ->when($this->search, fn($query) => $query->where('Description', 'like', '%' . $this->search . '%'))
            ->where('stock', '>', '0')
            ->get();
    }



};
?>

<div>

    {{$customer->name}}
    {{$customer->mobile}}




    <flux:modal.trigger name="new-order">
        <flux:button class="cursor-pointer">ثبت سفارش</flux:button>
    </flux:modal.trigger>

    <flux:modal name="new-order" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">فرم ثبت سفارش</flux:heading>
                <flux:text class="mt-2">اطلاعات مربوطه را پرکنید.</flux:text>
            </div>

            <flux:select wire:model="productId" variant="combobox" :filter="false" placeholder="انتخاب محصول"
                         label="تعداد" clearable>
                <x-slot name="input">
                    <flux:select.input wire:model.live="search"/>
                </x-slot>
                @foreach ($this->products as $product)
                    <flux:select.option value="{{ $product->id }}" wire:key="{{ $product->id }}">
                        {{ $product->Description }} - {{$product->stock}}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model="quantity" label="تعداد"/>


            <div class="flex">
                <flux:spacer/>
                <flux:button wire:click="save" type="submit" variant="primary">ذخیره</flux:button>
            </div>
        </div>
    </flux:modal>


</div>
