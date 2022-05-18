<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sale;
use Livewire\Component;

class AdminSaleComponent extends Component
{
    public $sale_date;
    public $active;


    public function mount()
    {
        $sale = Sale::find(1);
        $this->sale_date = $sale->sale_date;
        $this->active = $sale->actve;

    }

    public function render()
    {
        return view('livewire.admin.admin-sale-component')->layout('layouts.admin-c');
    }

    public function updateSale()
    {
        $sale = Sale::find(1);
        $sale->sale_date = $this->sale_date;
        $sale->active = $this->active;
        $sale->save();
        session()->flash('message', 'Record has been updated successfully');
    }
}
