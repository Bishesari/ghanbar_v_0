<?php

use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public $sortBy = 'id';
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
    public function customers()
    {
        return \App\Models\Customer::query()
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(10);
    }


};
?>

<div>
    <flux:table :paginate="$this->customers">

        <flux:table.columns>
            <flux:table.column>مشخصه</flux:table.column>
            <flux:table.column>نام</flux:table.column>
            <flux:table.column>شماره</flux:table.column>
            <flux:table.column>عملیات</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($this->customers as $customer)
                <flux:table.row :key="$customer->id">
                    <flux:table.cell class="whitespace-nowrap">{{ $customer->id }}</flux:table.cell>
                    <flux:table.cell
                        class="whitespace-nowrap">{{ $customer->name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $customer->mobile }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <flux:button href="{{route('customer.new_order', ['customer' => $customer])}}" variant="primary" color="sky">سفارش جدید</flux:button>
                    </flux:table.cell>

                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
