<?php

namespace App\Http\Livewire;

use App\Models\admin\Product;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $default_lang = get_default_lang();
        $sliders = HomeSlider::where('active', 1)->get();
        $lproducts = \App\Models\Product::orderBy('created_at','DESC')
            ->where('translation_lang', $default_lang)->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',',$category->sel_categories);
        $categories = Category::whereIn('id', $cats)
            ->where('translation_lang', $default_lang)->get();
        $no_of_products = $category->no_of_products;
        $sproducts = \App\Models\Product::where('sale_price', '>', 0)
            ->where('translation_lang', $default_lang)
            ->inRandomOrder()->get()->take(8);
        $sale = Sale::find(1);
        return view('livewire.home-component',
            ['sliders' => $sliders, 'lproducts'=> $lproducts, 'categories'=>$categories,
                'no_of_products'=>$no_of_products, 'sproducts'=>$sproducts, 'sale'=>$sale])
            ->layout('layouts.site');
    }
}
