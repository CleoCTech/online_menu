<?php

namespace App\Http\Livewire\Dashboard\Menu;

use App\Models\Allergene;
use App\Models\AllergicFood;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\DishPrice;
use App\Models\MenuCategory;
use App\Models\PriceCategory;
use App\Models\Restraunt;
use App\Events\DishCreatedEvent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditDish extends Component
{

    public $dishId;

    public $dishDetails;
    public $dishCategories= [];
    public $menuCategories= [];
    public $priceCategories= [];
    // public $priceCategories2= [];
    public $allergenesBucket = [];
    public $inputs = [];
    public $prices = [];
    public $pCatgeories = [];
    public $pCatgeoriesIds = [];
    public $i=0;
    // public $allergenesBucket;
    public $allergenes = [];
    public $dishAllergnes = [];
    public $actualdishAllergnes = [];
    public $dish_category_id, $menu_category_id, $dish_name = '';
    public $containsAllergene = false;
    public $frozen = false;

    protected $listeners = [
        'refreshCreateDishView' => '$refresh',
        'getactualdishAllergnes' => 'getactualdishAllergnes',
    ];

    protected $rules = [
        'dish_category_id' => 'required',
        'menu_category_id' => 'required',
        'dish_name' => 'required',
        'pCatgeories.0' => 'required',
        'pCatgeories.*' => 'required',
        'prices.0' => 'required',
        'prices.*' => 'required',
    ];

    public function mount($id)
    {
        session()->forget('files');
        $this->dishId = $id;
        $this->dishDetails = Dish::where('id', $this->dishId)->first();
        $this->menuCategories = MenuCategory::
        where('restraunt_id', auth()->user()->id)
        ->get();
        $this->dishCategories = DishCategory::
        where('restaurant_id', auth()->user()->id)
        ->get();
        $this->allergenes = Allergene::
        where('restaurant_id', auth()->user()->id)
        ->get();
        $this->dishAllergnes = AllergicFood::where('dish_id', $this->dishId)->get();
        if($this->dishAllergnes){
            $this->gatherdishAllergnes($this->dishAllergnes);
        }
        // $this->priceCategories2 = PriceCategory::
        // where('restaurant_id', auth()->user()->id)
        // ->get();
        $this->priceCategories = DishPrice::
        where('dish_id', $this->dishId)
        ->get();
        if($this->priceCategories != null){
            $this->dishPriceCategories();
        }
        $this->dish_name = $this->dishDetails->name;
        $this->dish_category_id = $this->dishDetails->grouping_id; //dish_category_id, $menu_category_id,
        $this->menu_category_id = $this->dishDetails->category_id; //dish_category_id, $menu_category_id,
        $this->folder = $this->dishDetails->folder;
        $this->filename = $this->dishDetails->filename;
        if ($this->dishDetails->allergnes == 1) {
            $this->containsAllergene = true;
        }
        if ($this->dishDetails->frozen == 1) {
            $this->frozen = true;
        }
    }
    public function render()
    {

        $restaurantName = Restraunt::where('id', auth()->user()->id)->first();
        return view('livewire.dashboard.menu.edit-dish', [
            'restaurantName' => $restaurantName,
        ]);
    }
    public function store()
    {
        // dd('her');
        $this->validate(
            $this->alert('error', 'You have an empty field!', [
                'position' => 'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
          ])
        );

        $success = false; //flag
	    DB::beginTransaction();
        try {

            $dish = Dish::where('id', $this->dishId)
            ->update([
                'name' => $this->dish_name,
                'category_id' => $this->menu_category_id,
                'grouping_id' => $this->dish_category_id,
                'frozen' => $this->frozen,
                'allergnes' => $this->containsAllergene,
            ]);

            DishPrice::where('dish_id', $this->dishId)
            ->delete();
            foreach ($this->inputs as $key => $value) {
                DishPrice::create([
                    'dish_id'=> $this->dishId,
                    'price'=> $this->prices[$key],
                    'category_id'=> $this->pCatgeoriesIds[$key],
                ]);
            }

            AllergicFood::where('dish_id', $this->dishId)
            ->delete();

            if($this->containsAllergene){
                foreach ($this->allergenesBucket as $key => $value) {
                    if ($value) {
                        AllergicFood::create([
                            'dish_id' => $this->dishId,
                            'allergene_id' => $key,
                        ]);
                    }
                }
            }

            $this->alert('success', 'Updated Successfully!', [
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
            if (session()->has('files')) {
                event(new DishCreatedEvent($dish->id));
            }
            $success = true;
            if($success){
                DB::commit();
                // $this->resetFields();
            }

        } catch (\Throwable $th) {
            DB::rollback();
		    $success = false;
            $this->alert('error', $th->getMessage(), [
                'position' =>  'top-end',
                'timer' =>  20000,
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
    public function getactualdishAllergnes()
    {
        $this->dispatchBrowserEvent('allergnes-updated', [
            'actualdishAllergnes' => $this->actualdishAllergnes
        ]);
    }
    public function gatherdishAllergnes($collection)
    {
        foreach($collection as $key => $value){
            array_push($this->actualdishAllergnes, $value->allergene_id);
        }
    }
    public function dishPriceCategories()
    {
        $this->pCatgeories = [];
        $this->prices = [];
        $this->pCatgeoriesIds = [];

        foreach ($this->priceCategories as $key => $value) {
            array_push($this->pCatgeories, $value->priceCategory->name);
            array_push($this->prices, $value->price);
            array_push($this->pCatgeoriesIds, $value->priceCategory->id);
            $this->i = $key;
            array_push($this->inputs , $key);

        }
    }
    public function openModal($modal, $pageTitle)
    {
        $this->emit('updateModal', $modal, $pageTitle);
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
    public function containAllergenes()
    {
        switch ($this->containsAllergene) {
            case 'false':
                $this->containsAllergene=true;
                break;
            case 'true':
                $this->containsAllergene=false;
                break;
            default:
                # code...
                break;
        }
        // dd($this->containsAllergene);
    }
    public function frozen()
    {
        switch ($this->frozen) {
            case 'false':
                $this->frozen=true;
                break;
            case 'true':
                $this->frozen=false;
                break;
            default:
                # code...
                break;
        }
    }
    public function resetFields()
    {
        $this->dish_name = '';
        $this->prices = '';
        $this->allergenesBucket = '';
        $this->dish_category_id = '';
        $this->menu_category_id = '';
        $this->frozen =false;
        $this->containsAllergene = false;
        session()->forget('files');
        $this->dispatchBrowserEvent('resetFields');
    }
}
