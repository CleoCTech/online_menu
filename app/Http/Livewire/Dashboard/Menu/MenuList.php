<?php

namespace App\Http\Livewire\Dashboard\Menu;

use App\Models\Dish;
use App\Models\Restraunt;
use Livewire\Component;
use Livewire\WithPagination;

class MenuList extends Component
{
    use WithPagination;

    public $resDetails;
    public function render()
    {
        $this->resDetails = Restraunt::where('id', auth()->user()->id)->first();
        $dishes = Dish::
        where('restaurant_id', auth()->user()->id)
        ->latest()
        ->paginate(10);

        return view('livewire.dashboard.menu.menu-list', compact('dishes', $dishes));
    }
}
