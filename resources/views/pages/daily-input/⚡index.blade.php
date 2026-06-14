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
    public function daily_inputs()
    {
        return \App\Models\DailyInput::query()
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }
};
?>

<div>

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
                    <flux:table.cell class="whitespace-nowrap">{{ $daily_input->product->Description }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ j_date($daily_input->date) }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $daily_input->qty }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap" dir="ltr">{{ currency($daily_input->price) }}</flux:table.cell>

                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>


</div>
