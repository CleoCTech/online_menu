<?php

namespace App\Http\Livewire\Dashboard\Tables;

use App\Models\RestrauntTable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantTables extends Component
{
    use WithPagination;

    public $categoryId, $modal;
    protected $listeners = ['render', 'render'];

    public function render()
    {
        $tableslist = RestrauntTable::
        where('restraunt_id', auth()->user()->id)
        ->latest()
        ->paginate(10);
        return view('livewire.dashboard.tables.restaurant-tables', compact('tableslist', $tableslist));
    }

    public function show($id)
    {
        $this->modal= 'livewire.dashboard.components.add-menu-category-modal';
    }
    public function activate($id)
    {
        DB::transaction(function () use ($id) {
            try {

                RestrauntTable::where('id', $id)
                ->update(['status' => 1]);

                $this->alert('success', 'Menu Activated Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);
            } catch (Exception $e) {
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
        });
    }
    public function deactivate($id)
    {
        DB::transaction(function () use ($id) {
            //check if any active
            $active = RestrauntTable::where('restraunt_id', auth()->user()->id)
            ->where('status', 1)
            ->first();

            if (! $active) {

                return $this->alert('error', 'You should have at least one table', [
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

            try {

                RestrauntTable::where('id', $id)
                ->update([
                    'status' => 0
                ]);

                $this->alert('success', 'Deactivated Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);

            } catch (Exception $e) {

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

        });
    }
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            try {

                RestrauntTable::find($id)->delete();

                $this->alert('success', 'Deleted Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);
            } catch (Exception $e) {
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
        });
    }
    public function openModal($modal, $pageTitle, $id)
    {
        $this->emit('editModal', $modal, $pageTitle, $id);
    }
}
