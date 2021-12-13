<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Http\Livewire\General\Modal;

class AddMenuFoodCategoryModal extends Modal
{
    public $catName;
    protected $rules = [
        'catName' => 'required',
    ];  

    public function render()
    {
        return view('livewire.dashboard.components.add-menu-food-category-modal');
    }
    public function store(){
        $this->validate();
        $success = false; //flag
	    DB::beginTransaction();
        try {
            MenuCategory::create([
                'name' => $this->catName,
                'restraunt_id' => auth()->user()->id,
            ]);
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
         
          $success = true;
          if ($success) {
            DB::commit();
            // $this->emit('render');
          }
        } catch (\Throwable $th) {
            DB::rollBack();
            $success = false;
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
      
    }
}
