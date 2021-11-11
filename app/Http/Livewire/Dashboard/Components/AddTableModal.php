<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\RestrauntTable;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddTableModal extends Component
{
    public $tableName;

    protected $rules = [
        'tableName' => 'required',
    ];
    public function render()
    {
        return view('livewire.dashboard.components.add-table-modal');
    }
    public function store(){
        $this->validate();
        DB::transaction(function () {
            try {
                
                $prefix = $this->tableName;
                $code = $this->genarateCode($prefix);
                RestrauntTable::create([
                    
                    'restraunt_id' => auth()->user()->id,
                    'name' => $this->tableName,
                    'code' => $code,
                ]);

                $domain = config('app.urlname');
                $domain = $domain .'r/';
                $qrcode = $domain . $code;
                // \QrCode::size(500)
                // ->format('png')
                //  ->generate($imageName, storage_path( 'app/public/qr-codes/'.$imageName.'.png' ));
                // Mail::to(auth()->user()->email)->send(new MailQrCode($qrcode, $imageName.'.png'));
                session()->flash('success', 'Saved Successfully');
                $this->alert('success', 'Saved Successfully', [
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
              $this->emit('render');
            } catch (Exception $e) {
                session()->flash('error', $e->getMessage());
                $this->alert('error', 'Oops! Something went wrong', [
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
            }
        });
    }
    public function genarateCode($prefix)
    {   
        $prefix = preg_replace('/\s+/', '_', $prefix);
        $code= '';
        $six_digit_random_number = random_int(100000, 999999) + 101029;
        $code = $prefix.$six_digit_random_number;

        $checkExists = RestrauntTable::where('code', $code)->first();
        if ($checkExists) {
            $this->genarateCode($prefix);
        }
        return $code;

    }
}