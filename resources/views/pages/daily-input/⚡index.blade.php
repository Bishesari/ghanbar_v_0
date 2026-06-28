<?php

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination;

    public $date;

    public $quantity;
    public $price;


    public $sortBy = 'date';
    public $sortDirection = 'desc';

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function daily_inputs()
    {
        return \App\Models\DailyInput::query()
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(10);
    }

    public $search = '';
    public $productId = null;

    #[\Livewire\Attributes\Computed]
    public function products()
    {
        return \App\Models\Product::query()
            ->when($this->search, fn($query) => $query->where('Description', 'like', '%' . $this->search . '%'))
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

        $product = Product::find($this->productId);

        $product['input'] += $this->quantity;

        $product['stock'] += $this->quantity;

        $product->save();



        Flux::modal('new-input')->close();
        $this->reset();
    }
};
?>

<div>


    <flux:modal.trigger name="new-input">
        <flux:button class="cursor-pointer">ثبت ورود به انبار</flux:button>
    </flux:modal.trigger>

    <flux:modal name="new-input" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">فرم ثبت ورود به انبار</flux:heading>
                <flux:text class="mt-2">اطلاعات مربوطه را پرکنید.</flux:text>
            </div>

            <flux:date-picker wire:model="date" with-today selectable-header locale="fa-IR" label="تعداد"/>

            <flux:select wire:model="productId" variant="combobox" :filter="false" placeholder="انتخاب محصول"
                         label="تعداد" clearable>
                <x-slot name="input">
                    <flux:select.input wire:model.live="search"/>
                </x-slot>
                @foreach ($this->products as $product)
                    <flux:select.option value="{{ $product->id }}" wire:key="{{ $product->id }}">
                        {{ $product->Description }}
                    </flux:select.option>
                @endforeach
            </flux:select>


            <flux:input wire:model="quantity" label="تعداد"/>
            <flux:input wire:model="price" label="قیمت"/>

            <div class="flex">
                <flux:spacer/>
                <flux:button wire:click="save" type="submit" variant="primary">ذخیره</flux:button>
            </div>
        </div>
    </flux:modal>


    <flux:separator class="mt-5"/>


    <flux:table :paginate="$this->daily_inputs">

        <flux:table.columns>
            <flux:table.column>مشخصه</flux:table.column>

            <flux:table.column>نام محصول</flux:table.column>

            <flux:table.column>تاریخ ورود</flux:table.column>
            <flux:table.column>تعداد</flux:table.column>
            <flux:table.column>قیمت</flux:table.column>

        </flux:table.columns>

        <flux:table.rows>
            @foreach ($this->daily_inputs as $daily_input)
                <flux:table.row :key="$daily_input->id">
                    <flux:table.cell class="whitespace-nowrap">{{ $daily_input->id }}</flux:table.cell>
                    <flux:table.cell
                        class="whitespace-nowrap">{{ $daily_input->product->Description }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ j_date($daily_input->date) }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $daily_input->qty }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap" dir="ltr"
                                     class="text-right">{{ currency($daily_input->price) }}</flux:table.cell>

                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>


</div>
