<?php

namespace App\Http\Livewire\Dashboard\Home\Components;

use App\Models\Dish;
use App\Models\MenuRequest;
use App\Models\Restraunt;
use App\Models\RestrauntTable;
use Carbon\Carbon;
use Livewire\Component;

class Summary extends Component
{
    public $resDetails;

    public function render()
    {
        $this->resDetails = Restraunt::where('id', auth()->user()->id)->first();
        $requests = MenuRequest::where('restaurant_code', $this->resDetails->code)
        ->where('table_code', '!=', 'favicon.png')
        ->count();

        $todayRequests = MenuRequest::where('restaurant_code', $this->resDetails->code)
        ->where('table_code', '!=', 'favicon.png')
        ->where('created_at', Carbon::today())
        ->count();

        $dishes = Dish::where('restaurant_id', auth()->user()->id)
        ->count();
        $activeDishes = Dish::where('restaurant_id', auth()->user()->id)
        ->where('status', 'active')
        ->count();

        $tables = RestrauntTable::where('restraunt_id', auth()->user()->id)
        ->count();
        $activeTables = RestrauntTable::where('restraunt_id', auth()->user()->id)
        ->where('status', 1)
        ->count();

        return view('livewire.dashboard.home.components.summary', [
            'requests' => $requests,
            'todayRequests' => $todayRequests,
            'dishes' => $dishes,
            'activeDishes' => $activeDishes,
            'tables' => $tables,
            'activeTables' => $activeTables
        ]);
    }
}
