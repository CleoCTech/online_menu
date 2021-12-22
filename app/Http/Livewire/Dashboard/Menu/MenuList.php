<?php

namespace App\Http\Livewire\Dashboard\Menu;

use App\Models\Dish;
use App\Models\Restraunt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MenuList extends Component
{
    use WithPagination;
    public $resDetails;
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $this->resDetails = Restraunt::where('id', auth()->user()->id)->first();
        $dishes = Dish::
        where('restaurant_id', auth()->user()->id)
        ->where('name','like', $searchTerm)
        ->latest()
        ->paginate(10);

        return view('livewire.dashboard.menu.menu-list', compact('dishes', $dishes));
    }
   public function show($id)
   {
       $this->emit('pageUpdate', 'edit-dish', $id);
   }
   public function activate($id)
    {
        $success = false; //flag
	    DB::beginTransaction();

        try {

            Dish::where('id', $id)
            ->update(['status' => 'Active']);
            $success = true;
            if($success){
                DB::commit();
            }
            $this->alert('success', 'Dish Activated Successfully', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
		    $success = false;
            $this->alert('error', 'Oops! Something went wrong', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
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

            Dish::where('id', $id)
            ->update(['status' => 'Inactive']);
            $success = true;
            if($success){
                DB::commit();
            }
            $this->alert('success', 'Dish Activated Successfully', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
		    $success = false;
            $this->alert('error', 'Oops! Something went wrong', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
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
        sleep(3);
        $this->alert('error', 'Oops! You have to explicitly confirm the action', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
