<?php

namespace App\Http\Livewire\Restraunt;

use App\Models\AllergicFood;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\MenuCategory;
use App\Models\MenuRequest;
use App\Models\Restraunt;
use App\Models\RestrauntTable;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Menu extends Component
{

    public $restaurant;
    public $table;
    public $resDetails;
    public $disheCategories = [];
    public $requestId;

    protected $listeners = [
        'updateScreenRes' => 'updateScreenResolution',
        'say-hello' => 'sayHello'
    ];

    public function mount($restaurant, $table){

        $this->restaurant = $restaurant;
        $this->table = $table;
        //store request parameters
        if (!$this->storeRequests($restaurant, $table, $this->checkDevice())) {
            session()->flash('error', 'Something went wrong with your request!' );
            return redirect()->route('signup');
        }

        //check device, if bot, exit;
        if ($this->checkDevice() == 'Bot' || $this->checkDevice() == 'Unknown')  {
            return;
        }
        //check if restaurant and table exist else error page
        $checkRes = Restraunt::where('code', $this->restaurant)->first();
        $this->resDetails = $checkRes;
        if ($checkRes) {

            $table= RestrauntTable::
            where('code', $this->table)
            ->where('restraunt_id', $checkRes->id)
            ->first();
            if (!$table) {
                #404 page
                session()->flash('error', 'Table Not Found!' );
                return redirect()->route('signup');
             }
            $activeMenu = MenuCategory::
            where('restraunt_id', $checkRes->id)
            ->where('status', 1)
            ->first();
            $this->disheCategories =  DishCategory::
            with('dishes')
            ->has('dishes')
            ->where('restaurant_id', $checkRes->id)
            // ->where('category_id', $activeMenu->id)
            ->get();

            // foreach ($this->disheCategories as $key => $dishCategory) {

            //     foreach ($dishCategory->dishes as $key => $dish) {
            //         dump($dish->name);
            //         dump($dish->prices);
            //     }

            // }
            // dd('done');

        } else {
            // return redirect()->route('404-page');
            session()->flash('error', 'Restaurant Not Found!' );
            return redirect()->route('signup');
        }
    }
    public function render()
    {

        return view('livewire.restraunt.menu', [

        ]
        )->layout('layouts.plain');
    }
    public function sayHello($payload)
    {
        $name = $payload['name'];
        dd($name);
        // your code here
    }
    public function storeRequests($restaurant_code, $table_code, $device_type)
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            $save = MenuRequest::create([
                'restaurant_code' => $restaurant_code,
                'table_code' => $table_code,
                'ip_address' => $this->get_ip_address(),
                'mac_address' => $this->get_mac_address(),
                'device_type' => $device_type,
                'os' => $this->get_os(),
                'browser' => $this->get_browser(),
            ]);
            $success = true;
            if($success){
                DB::commit();
                $this->requestId = $save->id;
                return true;
            }
        } catch (\Throwable $th) {
            $success = false;
            DB::rollback();
            return false;
        }

    }
    public function updateScreenResolution($value)
    {
        // dd($value['screen_resolution']);
        $success = false; //flag
        DB::beginTransaction();
        try {

            MenuRequest::where('id', $this->requestId)
            ->update([
                'screen_resolution' => $value['screen_resolution'],
                'status' => 'Successful',
            ]);
            $success = true;
            $success = true;
            if($success){
                DB::commit();
                // return true;
            }
        } catch (\Throwable $th) {
            $success = false;
            DB::rollback();
            // return false;
        }
    }
    public function checkDevice()
    {
        if (Browser::isMobile()) {
            return "Mobile";
        } else if(Browser::isTablet()){
            return "Tablet";
        } else if (Browser::isDesktop()){
            return "Desktop";
        } else if (Browser::isBot()){
            return "Bot";
        } else {
            return "Unknown";
        }
    }
    public function getAllergnes($id)
    {
        return AllergicFood::where('dish_id', $id)->get();
    }
    public function get_ip_address(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function get_mac_address()
    {
        return exec('getmac');
    }
    public function get_os()
    {
        return Browser::platformName();
    }
    public function get_browser()
    {
        return Browser::browserName();
    }
}
