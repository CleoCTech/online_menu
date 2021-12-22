<?php

namespace App\Http\Controllers;

use App\Mail\QrCode as MailQrCode;
use App\Models\Restraunt;
use App\Models\RestrauntFile;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;

class VerifyEmailController extends Controller
{

    public function verify(Request $request, $token)
    {
        // dd($token);
        $request->validate([
            'password' => 'required|min:8',
        ]);

        if ($request->password != $request->confirm_password) {
            return $request->session()->flash('error', 'Password did not match');
        }
        try {
            //bd5ae42f0756c719ffabef207b83790898936eb201946c4e52ee66765086894d
            $user =  Restraunt::where('token', $token)->first();

            if ($user) {
                //genarate unique code (use resttrauntname+uniquestring)
                $domain = config('app.urlname');
                $domain = $domain .'r/';
                $prefix = $user->name;
                $code = $this->genarateCode($prefix);
                $qrcode = $domain . $code;

                Restraunt::where('id', $user->id)
                ->update([
                    'code' =>$code,
                    'verified' =>1,
                    'email_verified_at' => now(),
                    'token' =>null,
                    'password' => Hash::make(($request->password)),
                    'status' => 'Complete'
                ]);

                //qr-code
                $imageName = uniqid() . '-' .Carbon::now()->timestamp;

                \QrCode::size(500)
                ->format('png')
                 ->generate($qrcode, storage_path( 'app/public/qr-codes/'.$imageName.'.png' ));

                RestrauntFile::create([
                    'restraunt_id'=>$user->id,
                    'folder'=>'qr-codes',
                    'filename'=>$imageName,
                ]);
                Mail::to($user->email)->send(new MailQrCode($qrcode, $imageName.'.png'));
                return redirect(route('r-dashboard', $code));
            } else {
                return redirect()->route('signup')->with(session()->flash('error', 'No such email'));
            }
        } catch (Exception $e) {
            return $request->session()->flash('error', $e->getMessage());
        }
    }

    public function genarateCode($prefix)
    {
        $prefix = preg_replace('/\s+/', '_', $prefix);
        $code= '';
        $six_digit_random_number = random_int(100000, 999999) + 101029;
        $code = $prefix.$six_digit_random_number;

        $checkExists = Restraunt::where('code', $code)->first();
        if ($checkExists) {
            $this->genarateCode($prefix);
        }
        return $code;

    }
    public function setpass($token)
    {
        $token = Restraunt::where('token', $token)->first();
        if (!$token) {
            return redirect()->route('signup')->with(session()->flash('error', 'Token Expired!'));
        }
        return view('set-password', ['token' => $token->token]);
    }
}
