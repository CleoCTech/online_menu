<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\PriceCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPriceCategoryModal extends Component
{

    public $editId;
    public $catName;

    protected $listeners = [
        'updateeditId' => 'updateeditId',
        'refreshEditPriceCat' => '$refresh'
    ];

    public function mount($id)
    {
        $this->editId = $id;

    }
    public function updateeditId($id)
    {
        $this->editId = $id;
        $this->emit('refreshEditPriceCat');
    }
    public function render()
    {
        if($this->editId != null){
            $getData = PriceCategory::where('id', $this->editId)->first();
            $this->catName = $getData->name;
        }
        return view('livewire.dashboard.components.edit-price-category-modal');
    }
    public function store()
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            PriceCategory::where('id', $this->editId)
            ->update([
                'name'=>$this->catName
            ]);

            $success = true;
            if ($success) {
                DB::commit();
                $this->alert('success', 'Updated Successfully', [
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
                // $this->emit('refreshMenuCategories');
            }
        } catch (Exception $e) {
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
