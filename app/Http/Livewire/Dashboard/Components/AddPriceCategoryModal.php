<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\PriceCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\General\Modal;

class AddPriceCategoryModal extends Modal
{
    use WithPagination;

    public $category;
    // public $categories;
    protected $rules = [
        'category' => 'required',
    ];
    public function render()
    {
        $categories = PriceCategory::
        where('restaurant_id', auth()->user()->id)
        ->latest()
        ->paginate(2);
        // $this->categories = $categories;
        return view('livewire.dashboard.components.add-price-category-modal', compact('categories', $categories));
    }
    public function store(){
        $this->validate();

        $success = false; //flag
        DB::beginTransaction();
        try {

            PriceCategory::create([
                'name' => $this->category,
                'restaurant_id' => auth()->user()->id
            ]);
            $success = true;
            if ($success) {
                DB::commit();
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
              $this->emit('refreshCreateDishView');
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
                $find = PriceCategory::find($id);
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
              $this->emit('refreshCreateDishView');
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
    public function activate($id)
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            //check if any active(can only be one active)
            $check = PriceCategory::where('restaurant_id', auth()->user()->id)
            ->where('status', 'Active')
            ->first();
            if ($check) {
                return $this->alert('error', 'You already have an price category running', [
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
            PriceCategory::where('id', $id)
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

            PriceCategory::where('id', $id)
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
    public function openModal($modal, $pageTitle, $id)
    {
        $this->emit('editModal', $modal, $pageTitle, $id);
    }
}