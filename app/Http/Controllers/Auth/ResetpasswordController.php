<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;


class ResetpasswordController extends Controller
{
    
    public function verifylink($id,$token){
        $email = User::where('id',$id)->value('email');
        $dd = DB::table('password_reset_tokens')->where('email',$email)->orderBy('created_at', 'desc')->first();
        $db_token = $dd->token;
        if ($db_token != $token){
          return redirect()->route('forgot_password')->withErrors('Opps! Invaild link, request for new link');
        }
    
        if (!$token || !$email){
          return redirect()->route('login');
        }
    
        $db_time = $dd->created_at;
        $tk_date = Carbon::parse($db_time);
        $now = Carbon::now();
    
    
          if($tk_date->diffInMinutes($now) <= 5){
            return view('auth.resetpassword')->with([
                'token' => $token,
                'email'=>$email
                ]
            );
          }else{
              return redirect()->route('forgot_password')->withErrors('Ooops! link expired, request for new link');
          }
    }
    public function updatepassword(Request $request){
  
      $request->validate([
        'email' => 'required|email|exists:users',
        'password' => ['required',
              'regex:/[a-z]/',      // must contain at least one lowercase letter
              'regex:/[A-Z]/',      // must contain at least one uppercase letter
              'regex:/[0-9]/',      // must contain at least one digit
              'regex:/[@$!%*#?&]/', // must contain a special character
              'min: 8',
              'confirmed'],
        'password_confirmation' => 'required',
  
    ]);
  
  
    $updatePassword = DB::table('password_reset_tokens')
                        ->where(['email' => $request->email, 'token' => $request->token])
                        ->first();
  
    if(!$updatePassword){
        return back()->withInput()->withErrors('Invalid token!');
    }
  
  
    $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
  
    return redirect()->route('login')->with('success', 'Your password has been changed successfully!');
  
    }

}
