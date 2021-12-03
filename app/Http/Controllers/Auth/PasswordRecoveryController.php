<?php

namespace App\Http\Controllers\Auth;

use App\Events\ResPasswordResetEvent;
use App\Http\Controllers\Controller;
use App\Mail\ResPasswordRecoveryMail;
use App\Models\PasswordReset as ModelsPasswordReset;
// use App\Models\PasswordReset;
use App\Models\Restraunt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;

class PasswordRecoveryController extends Controller
{


    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');
        $email = $request->route()->parameter('email');

        $checkCredentials = ModelsPasswordReset::where('email', $email)
        ->where('token', $token)
        ->first();

        if (!$checkCredentials) {
            return redirect()->route('restraunt-signin')->with('msg', 'Token Expired');
        }
        $url = 'r/password/update';
        return view('passwords.reset', ['url' =>$url, 'token' =>$token, 'email' =>$email]);
    }
    public function showForgetForm()
    {
        $token = Str::random(60);
        $token = hash('sha256', $token);
        $url = 'r/password/email';
        return view('passwords.forget', ['url' =>$url, 'token' =>$token]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $this->sendResetLink(
            $this->sendEmailcredentials($request)
        );
        return back()->with('status', 'We have emailed your password reset link');

    }
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.

        $credentials = $this->validateCredentials($this->credentials($request));
        $this->resetPassword(
            $credentials['user'],
            $credentials['password'],
        );
        return redirect()->route('restraunt-signin')->with('status', 'Your password has been updated successfully');

    }
    protected function validateCredentials($credentials)
    {
        if ($credentials['password'] == $credentials['password_confirmation']){
            $user = Restraunt::where('email', $credentials['email'])->first();
            if ($user) {
                return [
                    'user' => $user,
                    'password' => $credentials['password'],
                ];
            } else {
                throw ValidationException::withMessages([
                    $credentials['email'] => 'email does not exist with us',
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                $credentials['password'] => 'Password did not match.',
            ]);
        }
    }
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        // $user->setRememberToken(Str::random(60));

        $user->save();

        event(new ResPasswordResetEvent($user));

        // $this->guard()->login($user);
    }
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }
    protected function guard()
    {
        return Auth::guard('restraunt');
    }
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    protected function validationErrorMessages()
    {
        return [];
    }
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email', 'token' => 'required']);
    }
    protected function sendEmailcredentials(Request $request)
    {
        return $request->only('email', 'token');
    }
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }
    protected function sendResetLink($credentials)
    {
       //send email reset link;
       if ($this->checkEmail($credentials['email'])) {
            ModelsPasswordReset::create([
                'email' => $credentials['email'],
                'token' => $credentials['token']
            ]);
            Mail::to($credentials['email'])->send(new ResPasswordRecoveryMail($credentials['email'], $credentials['token']));
            // return back()->with('status', 'We have emailed your password reset link');
            // return redirect()->route('r-password-forget')->with('status', 'We have emailed your password reset link');
       } else {
        throw ValidationException::withMessages([
            $credentials['email'] => 'email does not exist with us',
        ]);
        return back()->withErrors($credentials['email'], 'something went wrong');
       }

    }
    protected function checkEmail($email)
    {
        $mail = Restraunt::where('email', $email)->first();
        if ($mail) {
            return true;
        }else{
            return false;
        }
    }

}