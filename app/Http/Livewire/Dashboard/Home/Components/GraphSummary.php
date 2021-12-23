<?php

namespace App\Http\Livewire\Dashboard\Home\Components;

use App\Models\MenuRequest;
use App\Models\Restraunt;
use App\Models\RestrauntTable;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Livewire\Component;

class GraphSummary extends Component
{
    protected $chart;
    public $tablesRequests =[];

    public function mount(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function render()
    {
        $tables = RestrauntTable::where('restraunt_id', auth()->user()->id)
        ->get();

        $allrequests = [];
        foreach ($tables as $key => $table) {
            $num = MenuRequest::where('table_code', $table->code)->count();
            // array_push($allrequests, $num);
            $allrequests += [$table->code => $num];
        }
        // dd($allrequests);
        $this->tablesRequests = [];
        array_multisort($allrequests, SORT_DESC);
        // dd($allrequests);
        $i=1;
        foreach ($allrequests as $key => $value) {
            // array_push($this->tablesRequests, $value);
            $this->tablesRequests += [$key => $value];
            if ($i == 3) {break;}
            $i++;
        }
        // dd($this->tablesRequests);
        $dataset = [];
        $labels = [];
        foreach ($this->tablesRequests as $key => $value) {
            array_push($dataset, $value);
            array_push($labels, $key);
        }

        $chart = (new LarapexChart)
                   ->setDataset($dataset)
                   ->setColors(['#754ffe', '#cec0ff', '#e8e2ff'])
                   ->setLabels($labels);
        $areaChart = $this->buildCustomerRequests();
        return view('livewire.dashboard.home.components.graph-summary', [
            'chart' => $chart,
            'areaChart' => $areaChart,
        ]);
    }

    public function buildCustomerRequests()
    {

        $restraunt = Restraunt::where('id', auth()->user()->id)->first();

        $dataset =[];
        for ($i=1; $i <=12; $i++) {
            $count = MenuRequest::where('restaurant_code', $restraunt->code)
            ->where('status', 'Successful')
            ->whereMonth('created_at', $i)->count();
            $dataset[] = $count;
        }
        $year = Carbon::now()->format('Y');
        return $this->chart->areaChart()
            ->setTitle('Restaurant Requests during '. $year)
            ->setColors(['#754ffe', '#cec0ff'])
            ->addData('Customer Requests', $dataset)
            ->setXAxis(['Jan', 'Feb', 'March', 'April', 'May', 'June', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec']);
    }
}