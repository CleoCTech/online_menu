<?php

namespace App\Http\Livewire\Dashboard\Home\Components;

use App\Models\Allergene;
use App\Models\DishCategory;
use App\Models\MenuCategory;
use App\Models\PriceCategory;
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
            if ($nextPage == 'create-dish') {
                //check prerequisites
                //check menu categories, dish categories, price categories, allergnes

                $menuCategories = MenuCategory::where('restraunt_id', auth()->user()->id)->get();
                $dishcategories =  DishCategory::where('restaurant_id', auth()->user()->id)->get();
                $pricecategories =  PriceCategory::where('restaurant_id', auth()->user()->id)->get();
                $allergnes =  Allergene::where('restaurant_id', auth()->user()->id)->get();

                if ($menuCategories->isEmpty()) {
                    $this->alert('error', 'Set menu categories as a prerequisite!', [
                        'position' => 'center',
                        'timer' =>  3000,
                        'toast' =>  true,
                        'text' =>  '',
                        'confirmButtonText' =>  'Ok',
                        'cancelButtonText' =>  'Cancel',
                        'showCancelButton' =>  false,
                        'showConfirmButton' =>  false,
                    ]);
                    return;
                }
                if ($dishcategories->isEmpty()) {
                    $this->alert('error', 'Set dish categories as a prerequisite!', [
                        'position' => 'center',
                        'timer' =>  3000,
                        'toast' =>  true,
                        'text' =>  '',
                        'confirmButtonText' =>  'Ok',
                        'cancelButtonText' =>  'Cancel',
                        'showCancelButton' =>  false,
                        'showConfirmButton' =>  false,
                    ]);
                    return;
                }
                if ($allergnes->isEmpty()) {
                    $this->alert('error', 'Set allergnes as a prerequisite!', [
                        'position' => 'center',
                        'timer' =>  3000,
                        'toast' =>  true,
                        'text' =>  '',
                        'confirmButtonText' =>  'Ok',
                        'cancelButtonText' =>  'Cancel',
                        'showCancelButton' =>  false,
                        'showConfirmButton' =>  false,
                    ]);
                    return;
                }
                if ($pricecategories ->isEmpty()) {
                    $this->alert('error', 'Set price categories as a prerequisite!', [
                        'position' => 'center',
                        'timer' =>  3000,
                        'toast' =>  true,
                        'text' =>  '',
                        'confirmButtonText' =>  'Ok',
                        'cancelButtonText' =>  'Cancel',
                        'showCancelButton' =>  false,
                        'showConfirmButton' =>  false,
                    ]);
                    return;
                }
                $this->emit('pageUpdate', $nextPage, '');
            }

        }

    }
}
