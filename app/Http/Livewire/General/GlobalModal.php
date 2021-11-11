<?php

namespace App\Http\Livewire\General;

use Livewire\Component;

class GlobalModal extends Component
{
    public $modal;
    public $pageTitle;

    protected $listeners = [
        'updateModal' => 'getModalName'
    ];

    public function render()
    {
        return view('livewire.general.global-modal');
    }

    public function getModalName($value, $pageTitle){
        $this->modal = $value;
        $this->pageTitle = $pageTitle;
    }
}