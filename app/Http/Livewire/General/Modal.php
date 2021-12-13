<?php

namespace App\Http\Livewire\General;

use Livewire\Component;
use Livewire\WithPagination;

class Modal extends Component
{
    use WithPagination;

    public $show = false;
    public $pageTitle;
    public $list = true;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show($value)
    {
        $this->show = true;
        $this->pageTitle = $value;
        // $this->list = $list;
    }
}
