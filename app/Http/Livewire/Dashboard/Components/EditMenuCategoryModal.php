<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditMenuCategoryModal extends Component
{
    public $editId;
    public $catName;

    protected $listeners = [
        'updateeditId' => 'updateeditId',
        'refreshEditMenu' => '$refresh'
    ];

    public function mount($id)
    {
        $this->editId = $id;

    }
    public function updateeditId($id)
    {
        $this->editId = $id;
        $this->emit('refreshEditMenu');
    }

    public function render()
    {
        if($this->editId != null){
            $getData = MenuCategory::where('id', $this->editId)->first();
            $this->catName = $getData->name;
        }
        return view('livewire.dashboard.components.edit-menu-category-modal');
    }
    public function store()
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            MenuCategory::where('id', $this->editId)
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
