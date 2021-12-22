<?php

namespace App\Http\Livewire\Dashboard\Components;

use App\Models\RestrauntTable;
use Illuminate\Support\Facades\DB;
use App\Models\Restraunt;
use App\Mail\QrCode as MailQrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Livewire\Component;

class EditTableModal extends Component
{
    public $editId;
    public $tableName;
    public $code;

    protected $listeners = [
        'updateeditId' => 'updateeditId',
        'refreshEditTable' => '$refresh'
    ];
    public function mount($id)
    {
        $this->editId = $id;
        if($this->editId != null){
            $getData = RestrauntTable::where('id', $this->editId)->first();
            $this->tableName = $getData->name;
            $this->code = $getData->code;
        }
    }
    public function render()
    {

        return view('livewire.dashboard.components.edit-table-modal');
    }
    public function updateeditId($id)
    {
        $this->editId = $id;
        $this->emit('refreshEditMenu');
    }
    public function onChange()
    {
        $prefix = $this->tableName;
        $code = $this->genarateCode($prefix);
        $this->code = $code;
    }
    public function store()
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            $prefix = $this->tableName;
            $code = $this->genarateCode($prefix);
            $res = Restraunt::where('id', auth()->user()->id)->first();
            RestrauntTable::where('id', $this->editId)
            ->update([
                'name' => $this->tableName,
                'code' => $this->code,
            ]);
            $domain = config('app.urlname');
            $domain = $domain .'r/'.$res->code .'/';
            $qrcode = $domain . $this->code;
             //qr-code
            $imageName = uniqid() . '-' .Carbon::now()->timestamp;
            \QrCode::size(500)
            ->format('png')
             ->generate($qrcode, storage_path( 'app/public/qr-codes/'.$imageName.'.png' ));
            Mail::to(auth()->user()->email)->send(new MailQrCode($qrcode, $imageName.'.png'));

            $success = true;
            if ($success) {
                DB::commit();
                $this->alert('success', 'Updated Successfully', [
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
        } catch (\Throwable $th) {
            DB::rollBack();
            $success = false;
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