<?php

namespace App\Http\Livewire\Dashboard\Menu;


use App\Models\MenuCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MenuFoodCategories extends Component
{

    use WithPagination;
    public $categoryId, $modal, $catName;
    protected $listeners = ['render', 'render'];

    public function render()
    {
        $menulist = MenuCategory::
        where('restraunt_id', auth()->user()->id)
        ->latest()
        ->paginate(10);
        return view('livewire.dashboard.menu.menu-food-categories',[
            'menulist' => $menulist
        ]);
    }
    public function try($id)
    {
        dd($id);
    }
}
