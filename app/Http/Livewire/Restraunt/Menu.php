<?php

namespace App\Http\Livewire\Restraunt;

use App\Models\AllergicFood;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\MenuCategory;
use App\Models\Restraunt;
use App\Models\RestrauntTable;
use Livewire\Component;

class Menu extends Component
{

    public $restaurant;
    public $table;
    public $resDetails;
    public $disheCategories = [];

    public function mount($restaurant, $table){
        $this->restaurant = $restaurant;
        $this->table = $table;
        // dd($restaurant . $table);

        //check if restaurant and table exist else error page
        $checkRes = Restraunt::where('code', $this->restaurant)->first();
        $this->resDetails = $checkRes;
        if ($checkRes) {

            $table= RestrauntTable::
            where('code', $this->table)
            ->where('restraunt_id', $checkRes->id)
            ->first();

            $activeMenu = MenuCategory::
            where('restraunt_id', $checkRes->id)
            ->where('status', 1)
            ->first();
            $this->disheCategories =  DishCategory::
            where('restaurant_id', $checkRes->id)
            // ->where('category_id', $activeMenu->id)
            ->get();
            if (!$table) {
               #404 page
               session()->flash('error', 'Table Not Found!' );
               return redirect()->route('signup');
            }


        }else {
            // return redirect()->route('404-page');
            session()->flash('error', 'Restaurant Not Found!' );
            return redirect()->route('signup');
        }
    }
    public function render()
    {
        //check if restaurant and table exist else error page
        // $checkRes = Restraunt::where('code', $this->restaurant)->first();
        // if ($checkRes) {

        //     $table= RestrauntTable::
        //     where('code', $this->table)
        //     ->where('restraunt_id', $checkRes->id)
        //     ->first();
        //     if (!$table) {
        //        #menu
        //        session()->flash('error', 'Table Not Found!' );
        //        return redirect()->route('signup');
        //     }

        // }else {
        //     // return redirect()->route('404-page');
        //     session()->flash('error', 'Restaurant Not Found!' );
        //     return redirect()->route('signup');
        // }

        return view('livewire.restraunt.menu', [

        ]
        )->layout('layouts.plain');
    }

    public function getAllergnes($id)
    {
        return AllergicFood::where('dish_id', $id)->get();
    }
}