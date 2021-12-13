<?php

namespace App\Http\Livewire\Dashboard\Home\Components;

use Livewire\WithPagination;
use Livewire\Component;

class PageHaeder extends Component
{
    use WithPagination;

    public $rightBtnClass ="btn btn-outline-white";
    public $rightActionBtn;
    public $title;
    public $pageThread = false;
    public $nextPage;
    public $icon = false;
    public $threads = [];
    public $getModal = false;
    public $pageTitle;



    public function mount($title, $rightActionBtn, $rightBtnClass, $pageThread, $getModal, $nextPage, $pageTitle, $icon, array $threads)
    {
        // dd($threads);
        // unset($this->threads);
        $this->threads = array();
        $this->title = $title;
        $this->rightActionBtn = $rightActionBtn;
        $this->rightBtnClass = $rightBtnClass;
        $this->pageThread = $pageThread;
        $this->getModal = $getModal;
        $this->nextPage = $nextPage;
        $this->pageTitle = $pageTitle;
        $this->icon = $icon;
        if ($threads !=null) {
            foreach ($threads as $key => $value) {
                array_push($this->threads, $value);
            }
        }
        // dd($this->threads);
    }
    public function render()
    {
        return view('livewire.dashboard.home.components.page-haeder');
    }
    public function rightBtnAction($nextPage, $pageTitle)
    {
        if ($this->getModal) {
            $this->emit('updateModal', $nextPage, $pageTitle);
            // $this->emitTo($nextPage, 'show', $pageTitle);
        }else{
            $this->emit('pageUpdate', $nextPage, '');
        }

    }
}
