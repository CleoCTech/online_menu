<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddMenuCategoryModal extends Component
{
    public $catName;

    protected $listeners = [
        
    ];
    protected $rules = [
        'catName' => 'required',
    ];  
    public function render()
    {
        return view('livewire.dashboard.components.add-menu-category-modal');
    }

    public function store(){
        $this->validate();
        DB::transaction(function () {
            try {
                
                MenuCategory::create([
                    'name' => $this->catName,
                    'restraunt_id' => auth()->user()->id,
                ]);
                session()->flash('success', 'Saved Successfully');
                $this->alert('success', 'Saved Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'position'=>'top-right',
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
              ]);
              $this->emit('render');
            } catch (Exception $e) {
                session()->flash('error', $e->getMessage());
                $this->alert('error', 'Oops! Something went wrong', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'position'=>'top-right',
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
                ]);
            }
        });
    }
}