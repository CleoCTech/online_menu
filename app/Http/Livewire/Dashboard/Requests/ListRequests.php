<?php

namespace App\Http\Livewire\Dashboard\Requests;

use App\Models\MenuRequest;
use App\Models\Restraunt;
use App\Models\RestrauntTable;
use Livewire\WithPagination;
use Livewire\Component;

class ListRequests extends Component
{
    use WithPagination;

    public $resDetails;
    public $searchTerm;
    public $count =5000;

    public function render()
    {
        $this->resDetails = Restraunt::where('id', auth()->user()->id)->first();
        $searchTerm = '%'.$this->searchTerm.'%';
        $requests = MenuRequest::where('restaurant_code', $this->resDetails->code)
        ->where('table_code', '!=', 'favicon.png')
        ->where('table_code','like', $searchTerm)
        ->latest()
        ->paginate(20);

        $this->count =  number_format($requests->count());
        $tables = RestrauntTable::where('restraunt_id', auth()->user()->id)
        ->get();
        return view('livewire.dashboard.requests.list-requests', [
            'requests' => $requests,
            'tables' => $tables
        ]);
    }
    public function filter($value)
    {
        $this->searchTerm = $value;
    }
}
