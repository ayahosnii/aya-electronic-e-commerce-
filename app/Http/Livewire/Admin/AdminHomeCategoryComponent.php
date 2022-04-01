<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories = [];
    public $numberofproducts;

    public function mount()
    {
        $category = HomeCategory::find(1);
        $this->selected_categories = explode(',',$category->sel_categories);
        $this->numberofproducts = $category->no_of_products;
    }

    public function updateHomeCategory()
    {
        $category = HomeCategory::find(1);
        $this->sel_categories = implode(',',$category->selected_categories);
        $this->no_of_products = $category->numberofproducts;
        $category->save();
        session()->flash('message', 'HomeCategory has been updated successfully!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('admin.home-category.create', ['categories' => $categories])->layout('layouts.admin-c');
    }
}
