<?php

namespace App\Http\Livewire\Dashboard\Menu;

use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MenuCategories extends Component
{

    use WithPagination;
    public $categoryId, $modal, $catName;
    public $searchTerm;

    protected $listeners = ['refreshMenuCategories', '$refresh'];

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $menulist = MenuCategory::
        where('restraunt_id', auth()->user()->id)
        ->where('name','like', $searchTerm)
        ->latest()
        ->paginate(10);
        return view('livewire.dashboard.menu.menu-categories', compact('menulist', $menulist));
    }
    public function openModal($modal, $pageTitle, $id)
    {
        $this->emit('editModal', $modal, $pageTitle, $id);
    }
    public function try($id)
    {
        dd($id);
    }
    public function activate($id)
    {

        DB::transaction(function () use ($id) {
            try {

                MenuCategory::where('id', $id)
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
            $active = MenuCategory::where('restraunt_id', auth()->user()->id)
            ->where('status', 1)
            ->first();

            if (! $active) {

                return $this->alert('error', 'You should have at least one active menu category', [
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

                MenuCategory::where('id', $id)
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

                MenuCategory::find($id)->delete();

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
                //'Oops! Something went wrong'
                $this->alert('error', $e->getMessage(), [
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

}
