<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $image, $alt, $title, $description, $price, $modalId;

    public function __construct($image, $alt, $title, $description, $price, $modalId)
    {
        $this->image = $image;
        $this->alt = $alt;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->modalId = $modalId;
    }

    public function render()
    {
        return view('components.service-card');
    }
}
