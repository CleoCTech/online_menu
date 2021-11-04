<?php

namespace App\Http\Livewire;

use App\Mail\VerifyMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class SignupFeedback extends Component
{

    public $link;

    public function mount($link){
        $this->link =$link;
    }
    public function render()
    {
        return view('livewire.signup-feedback');
    }

    public function resendLink()
    {
        try {
            Mail::to($this->link)->send(new VerifyMail($this->link));
            $this->alert('success', 'Email Sent successfully', [
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
            $this->alert('error', $e->getMessage(), [
                'position' =>  'top-end',
                'timer' =>  10000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
           ]);
        }

    }
}
