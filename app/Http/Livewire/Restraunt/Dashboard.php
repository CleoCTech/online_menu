<?php

namespace App\Http\Livewire\Restraunt;

use Livewire\Component;

class Dashboard extends Component
{
    public $page;

    protected $listeners = [
        'pageUpdate' => 'pageUpdate',
    ];

    public function mount()
    {
        $this->page = "dashboard";
    }
    public function render()
    {
        return view('livewire.restraunt.dashboard')->layout('layouts.dashboard');
    }
    public function pageUpdate($page, $itemId)
    {
        $this->page = $page;
        $this->itemId = $itemId;
        // $this->dispatchBrowserEvent('dateFormat',['id' => 'evntStartDate']);
        $this->dispatchBrowserEvent('stateChanged');
    }
}