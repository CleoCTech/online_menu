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

        try {
            DB::transaction();
            PriceCategory::create(['name' => $this->category]);
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
        //   $this->emit('render-dishes');
        $this->emit('refreshCreateDishView');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
}