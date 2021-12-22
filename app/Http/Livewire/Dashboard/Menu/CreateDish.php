<?php

namespace App\Http\Livewire\Dashboard\Menu;

use App\Events\DishCreatedEvent;
use App\Models\Allergene;
use App\Models\AllergicFood;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\DishPrice;
use App\Models\MenuCategory;
use App\Models\PriceCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateDish extends Component
{
    public $dishCategories= [];
    public $menuCategories= [];
    public $priceCategories= [];
    public $allergenesBucket = [];
    public $inputs = [];
    public $prices = [];
    public $pCatgeories = [];
    public $pCatgeoriesIds = [];
    public $i=0;
    // public $allergenesBucket;
    public $allergenes = [];
    public $dish_category_id, $menu_category_id, $dish_name = '';
    public $containsAllergene = false;
    public $frozen = false;

    protected $listeners = ['refreshCreateDishView' => '$refresh'];

    protected $rules = [
        'dish_category_id' => 'required',
        'menu_category_id' => 'required',
        'dish_name' => 'required',
        'pCatgeories.0' => 'required',
        'pCatgeories.*' => 'required',
        'prices.0' => 'required',
        'prices.*' => 'required',
    ];


    public function mount()
    {
        session()->forget('files');
        $this->menuCategories = MenuCategory::
        where('restraunt_id', auth()->user()->id)
        ->get();
        $this->dishCategories = DishCategory::
        where('restaurant_id', auth()->user()->id)
        ->get();
        $this->allergenes = Allergene::
        where('restaurant_id', auth()->user()->id)
        ->get();
        $this->priceCategories = PriceCategory::
        where('restaurant_id', auth()->user()->id)
        ->get();
        if($this->priceCategories != null){
            $this->dishPriceCategories();
        }
    }
    public function render()
    {
        return view('livewire.dashboard.menu.create-dish');
    }
    public function dishPriceCategories()
    {
        $this->pCatgeories = [];
        // $this->prices = [];
        $this->pCatgeoriesIds = [];

        foreach ($this->priceCategories as $key => $value) {
            array_push($this->pCatgeories, $value->name);
            // array_push($this->prices, 0);
            array_push($this->pCatgeoriesIds, $value->id);

            $this->i = $key;
            array_push($this->inputs , $key);
        }
    }
    public function openModal($modal, $pageTitle)
    {
        $this->emit('updateModal', $modal, $pageTitle);
    }
    public function store()
    {
        $this->validate(
            $this->alert('error', 'You have an empty field!', [
                'position' => 'center',
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

            $dish = Dish::create([
                'name' => $this->dish_name,
                'restaurant_id' => auth()->user()->id,
                'category_id' => $this->menu_category_id,
                'grouping_id' => $this->dish_category_id,
                'frozen' => $this->frozen,
                'allergnes' => $this->containsAllergene,
            ]);

            foreach ($this->inputs as $key => $value) {
                DishPrice::create([
                    'dish_id'=> $dish->id,
                    'price'=> $this->prices[$key],
                    'category_id'=> $this->pCatgeoriesIds[$key],
                ]);
            }
            if($this->containsAllergene){

                foreach ($this->allergenesBucket as $key => $value) {
                    if ($value) {
                        AllergicFood::create([
                            'dish_id' => $dish->id,
                            'allergene_id' => $key,
                        ]);
                    }
                }
            }
            $this->alert('success', 'Saved Successfully!', [
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
                $this->resetFields();
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
    public function addAllergene($id)
    {
        $holder = [];
        for ($i=0; $i < 5; $i++) {
            dump('yes');
            array_push($holder, $i);
        }
        dd($holder);
        if (!empty($this->allergenesBucket)) {
            dump(' not empty');
            foreach ($this->allergenesBucket as $key => $value) {
                array_push($holder, $value);
            }
            // array_push($holder, $value);
        }
        array_push($this->allergenesBucket, $id);
        $key = $this->searchForId($id, $this->allergenesBucket);
        dd($key);

        if($key != -1){//remove id
            unset($this->allergenesBucket[$key]);
        }else{//add id
            array_push($this->allergenesBucket, $id);
        }
    }
    public function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val === $id) {
                return $key;
            }
        }
        return null;
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
    public function test(){
        session()->forget('files');
        $this->dispatchBrowserEvent('resetFields');
    }
}
