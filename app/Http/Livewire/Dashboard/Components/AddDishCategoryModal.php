<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\DishCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddDishCategoryModal extends Component
{
    use WithPagination;

    public $category;

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

        try {
            DB::transaction();
            DishCategory::create(['name' => $this->category]);
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
}