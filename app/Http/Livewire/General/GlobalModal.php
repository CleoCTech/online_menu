<?php

namespace App\Http\Livewire\General;

use Livewire\Component;

class GlobalModal extends Component
{
    public $modal;
    public $pageTitle;
    public $editId;

    protected $listeners = [
        'updateModal' => 'getModalName',
        'refresh' => '$refresh',
        'editModal' => 'editModal'
    ];

    public function render()
    {
        return view('livewire.general.global-modal');
    }

    public function getModalName($value, $pageTitle){
        $this->modal = $value;
        $this->pageTitle = $pageTitle;
    }
    public function editModal($modal, $pageTitle, $id)
    {
        $this->modal = $modal;
        $this->pageTitle = $pageTitle;
        $this->emit('updateeditId', $id);
        $this->editId = $id;
    }
}