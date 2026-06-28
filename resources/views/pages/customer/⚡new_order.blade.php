<?php

use App\Models\Customer;
use Livewire\Component;

new class extends Component {
    public Customer $customer;



};
?>

<div>

    {{$customer->name}}
    {{$customer->mobile}}


</div>
