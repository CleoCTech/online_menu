<?php

namespace App\Http\Livewire\Dashboard\Inc;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.dashboard.inc.navbar');
    }
    public function menuCategories()
    {
        $this->emit('pageUpdate', 'menu-cat', '');
        // $this->dispatchBrowserEvent('stateChanged');

    }
    public function servingTables()
    {
        $this->emit('pageUpdate', 'tables', '');
    }
}
