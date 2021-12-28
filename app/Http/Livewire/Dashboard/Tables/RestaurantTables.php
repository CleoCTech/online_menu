<?php

namespace App\Http\Livewire\Dashboard\Tables;

use App\Models\RestrauntTable;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\QrCode as MailQrCode;
use App\Models\Restraunt;
use App\Models\RestrauntFile;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantTables extends Component
{
    use WithPagination;

    public $categoryId, $modal;
    public $searchTerm;

    protected $listeners = ['render', 'render'];

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $tableslist = RestrauntTable::
        where('restraunt_id', auth()->user()->id)
        ->where('name','like', $searchTerm)
        ->latest()
        ->paginate(10);
        return view('livewire.dashboard.tables.restaurant-tables', compact('tableslist', $tableslist));
    }

    public function show($id)
    {
        $this->modal= 'livewire.dashboard.components.add-menu-category-modal';
    }
    public function activate($id)
    {
        DB::transaction(function () use ($id) {
            try {

                RestrauntTable::where('id', $id)
                ->update(['status' => 1]);

                $this->alert('success', 'Menu Activated Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);
            } catch (Exception $e) {
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
        });
    }
    public function deactivate($id)
    {
        DB::transaction(function () use ($id) {
            //check if any active
            $active = RestrauntTable::where('restraunt_id', auth()->user()->id)
            ->where('status', 1)
            ->first();

            if (! $active) {

                return $this->alert('error', 'You should have at least one table', [
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

            try {

                RestrauntTable::where('id', $id)
                ->update([
                    'status' => 0
                ]);

                $this->alert('success', 'Deactivated Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);

            } catch (Exception $e) {

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

        });
    }
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            try {

                RestrauntTable::find($id)->delete();

                $this->alert('success', 'Deleted Successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);
            } catch (Exception $e) {
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
        });
    }
    public function getQrCode($id, $code)
    {
        $success = false; //flag
        DB::beginTransaction();
        try {

            $getFile = RestrauntFile::where('restraunt_id', auth()->user()->id)
            ->where('fileable_id', $id)
            ->where('fileable_type', 'App\Models\RestrauntTable')
            ->first();

            $res = Restraunt::where('id', auth()->user()->id)->first();

            $domain = config('app.urlname');
            $domain = $domain .'r/'.$res->code .'/';
            $qrcode = $domain . $code;

            Mail::to(auth()->user()->email)->send(new MailQrCode($qrcode, $getFile->filename.'.png'));
            $success = true;
            if ($success) {
                DB::commit();
                $this->alert('success', 'The QR Code has been sent to your email address', [
                    'position' =>  'top-end',
                    'timer' =>  5000,
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
            $success = false; //Oops! Something went wrong, contact the system Admin
            $this->alert('error', $th->getMessage(), [
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
    public function openModal($modal, $pageTitle, $id)
    {
        $this->emit('editModal', $modal, $pageTitle, $id);
    }
}