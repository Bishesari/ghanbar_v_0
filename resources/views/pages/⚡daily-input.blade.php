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

<div>
    <flux:date-picker locale="fa-IR" wire:model="date" with-today selectable-header/>


    <flux:select wire:model="productId" variant="combobox" :filter="false">
        <x-slot name="input">
            <flux:select.input wire:model.live="search" />
        </x-slot>
        @foreach ($this->products as $product)
            <flux:select.option value="{{ $product->id }}" wire:key="{{ $product->id }}">
                {{ $product->Description }}
            </flux:select.option>
        @endforeach
    </flux:select>


    <flux:input wire:model="quantity" label="تعداد"/>
    <flux:input wire:model="price" label="قیمت"/>

    <flux:button variant="primary" color="amber" wire:click="save">ذخیره</flux:button>



</div>
