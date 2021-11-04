<?php

namespace App\Http\Livewire;

use App\Events\NewSignupEvent;
use App\Mail\VerifyMail;
use App\Models\Restraunt;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class Signup extends Component
{
    public $varView;
    public $email;
    public $token;
    public $restraunt;

    protected $listeners =['update_Varview' => 'updateVarview'];

    protected $rules = [
        'email' => 'required|email',
        'restraunt' => 'required',
    ];

    protected $messages = [
        'email.required' => 'The Email Address cannot be empty.',
        'email.email' => 'The Email Address format is not valid.',
        'restraunt.required' => 'Restraunt Name required.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $token = Str::random(60);
        $this->token = hash('sha256', $token);
    }

    public function render()
    {
        return view('livewire.signup');
    }

    public function signup()
    {
        $this->validate();
        // dd($this->email);
        // Mail::to($this->email)->send(new VerifyMail($this->email));
        try {
            DB::transaction(function () {
                $res = Restraunt::create([
                    'name' => $this->restraunt,
                    'email' => $this->email,
                    'token' => $this->token,
                    'status' => 'Pending',
                ]);
                Mail::to($this->email)->send(new VerifyMail($this->token));
                $this->alert('success', 'Registered successfully', [
                    'position' =>  'top-end',
                    'timer' =>  3000,
                    'toast' =>  true,
                    'text' =>  '',
                    'confirmButtonText' =>  'Ok',
                    'cancelButtonText' =>  'Cancel',
                    'showCancelButton' =>  false,
                    'showConfirmButton' =>  false,
               ]);
               $this->emit('update_Varview', 'feedback');
            });

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
    public function updateVarview($value)
    {
        $this->varView = $value;
    }
}
