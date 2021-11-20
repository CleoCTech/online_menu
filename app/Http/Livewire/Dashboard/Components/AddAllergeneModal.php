<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\Allergene;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AddAllergeneModal extends Component
{
    use WithPagination;

    public $allergene;

    protected $rules = [
        'allergene' => 'required',
    ];
    public function render()
    {
        $allergenes = Allergene::
        where('restaurant_id', auth()->user()->id)
        ->latest()
        ->paginate(2);
        return view('livewire.dashboard.components.add-allergene-modal', compact('allergenes', $allergenes));
    }
    public function store(){
        $this->validate();

        DB::transaction(function () {
            try {
                
                Allergene::create(['name' => $this->allergene, 'restaurant_id' => auth()->user()->id]);
               
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

    public function delete($id)
    {
        DB::transaction(function () use ($id) {
             try {
                $find = Allergene::find($id);
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