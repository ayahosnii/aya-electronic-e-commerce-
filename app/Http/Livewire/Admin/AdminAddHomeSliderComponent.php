<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Carbon\Carbon;
class AdminAddHomeSliderComponent extends Component
{
    public $title;
    public $subtitle;
    public $price;
    public $link;
    public $image;
    public $active;

    public function mount()
    {
        $this->active = 0;
    }

    public function addSlide()
    {
        $slider = new HomeSlider();
        $slider -> title = $this-> title;
        $slider -> subtitle = $this-> subtitle;
        $slider -> price = $this-> price;
        $slider -> link = $this-> link;
        $imagename = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image = storeAs('sliders', $imagename);
        $slider -> image = $this-> image;
        $slider -> active = $this-> active;
        $slider->save();
        with('message', 'Slide has been created successfully!!');
    }

    public function render()
    {
        return view('admin.homeslider.create')->layout('layouts.admin-c');
    }
}
