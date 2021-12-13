<?php

namespace App\Http\Livewire\Dashboard\Components;

use Livewire\WithPagination;
use Livewire\Component;

class Pagination extends Component
{

    use WithPagination; 
    public $categories;

    public function mount($categories)
    {
        $this->categories = $categories;
    }
    public function render()
    {
        return view('livewire.dashboard.components.pagination', [
            'categories' => $this->categories
        ]);
    }
}
