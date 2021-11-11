<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signin extends Component
{

    use AuthenticatesUsers;

    public $email;
    public $password;
    public $remember =false;

    public $redirectTo = '/r/dashboard';

    protected $rules = [
        'email'   => 'required|email',
        'password' => 'required|min:8'
    ];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:restraunt')->except('logout');
    }

    public function render()
    {
        return view('livewire.signin')
        ->with(['url' => '/r/dashboard'])
        ->layout('layouts.plain');
    }

    public function signin()
    {
        $this->validate();

        if (Auth::guard('restraunt')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {

            return redirect()->intended('/r/dashboard');
        }
        $this->alert('error', 'Something went wrong', [
            'position' =>  'top-end',
            'timer' =>  10000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
       ]);
        // return back()->withInput($request->only('email', 'remember'));
    }
}
