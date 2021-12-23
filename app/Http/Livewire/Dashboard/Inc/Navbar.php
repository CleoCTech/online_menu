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
    public function menuList()
    {
        $this->emit('pageUpdate', 'menu-list', '');
    }
    public function requests()
    {
        $this->emit('pageUpdate', 'requests', '');
    }
    public function dashboard()
    {
        $this->emit('pageUpdate', 'dashboard', '');
    }
    public function createDish()
    {
        $this->emit('pageUpdate', 'create-dish', '');
    }
    public function openModal($modal, $pageTitle)
    {
        $this->emit('updateModal', $modal, $pageTitle);
    }
}
