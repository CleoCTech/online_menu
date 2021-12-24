<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\DishCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\General\Modal;

class AddDishCategoryModal extends Modal
{
    use WithPagination;

    public $category;
    public $editId = '';
    protected $rules = [
        'category' => 'required',
    ];

    public function render()
    {
        $categories = DishCategory::
        where('restaurant_id', auth()->user()->id)
        ->latest()
        ->paginate(2);
        return view('livewire.dashboard.components.add-dish-category-modal', compact('categories', $categories));
    }
    public function store(){
        $this->validate();
        $success = false; //flag
	    DB::beginTransaction();
        try {
            DishCategory::create([
                'name' => $this->category,
                'restaurant_id' => auth()->user()->id
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
    public function update()
    {
        $this->validate();
        $success = false; //flag
        DB::beginTransaction();
        try {

            DishCategory::where('id', $this->editId)
            ->update([
                'name' => $this->category,
            ]);

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
            $success = true;
            if ($success) {
                DB::commit();
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
    public function activate($id)
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            DishCategory::where('id', $id)
            ->update([
                'status' => 'Active',
            ]);

            $this->alert('success', 'Activated Successfully', [
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
    public function deactivate($id)
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            DishCategory::where('id', $id)
            ->update([
                'status' => 'Inactive',
            ]);

            $this->alert('success', 'Deactivated Successfully', [
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
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
             try {
                $find = DishCategory::find($id);
                $find->delete();

                $this->alert('success', 'Deleted Successfully', [
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
             } catch (\Throwable $th) {
                $this->alert('error', $th->getMessage(), [
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
    public function openModal($modal, $pageTitle)
    {
        $this->emit('updateModal', $modal, $pageTitle);
        $this->emitUp('showModal', true);
        $this->dispatchBrowserEvent('showModal', true);
    }
    public function getItem($id)
    {
        $getCategory = DishCategory::select('id', 'name')
        ->where('id', $id)->first();
        if ($getCategory) {
            $this->category = $getCategory->name;
            $this->editId = $getCategory->id;
        }
        $this->list = false;
    }
    public function back()
    {
        $this->list = true;
        $this->category = null;
        $this->editId = null;
    }
}
