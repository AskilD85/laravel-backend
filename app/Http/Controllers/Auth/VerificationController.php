<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\User;
use Carbon\Carbon;
class VerificationController extends Controller
{

    
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;
    
   
    
    /*public function verify(Request $request)
    {
        // ->route('id') gets route user id and getKey() gets current user id() 
        // do not forget that you must send Authorization header to get the user from the request
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            $request->user()->getKey() == null;
        } else {
        	return 	response()->json([
        			'result' => 'error',
        			'text' => 'link is incorrect!'
        		]);
        }
        
        
        return response()->json([
        	'result' => 'ok',
        	'text' => 'Email verified!',
        	'request' => $request->user()->markEmailAsVerified()
        	]);
        
		// return redirect($this->redirectPath());
    }*/
    
     public function verify($token)
	{
		$user = User::where('verify_token', $token)->first();
		
	    if (!$user) {
	        	return response()->json([
	        			'result' => 'error',
	        			'text' => 'ссылка не работает!'
	        		]);
	    }
	
		// $user->status = User::STATUS_ACTIVE;
	    $user->email_verified_at = Carbon::now();
	    $user->status = User::STATUS_ACTIVE;
	    $user->verify_token = null;
	    $user->save();
	
		return response()
			->json([
    			'result' => 'OK',
    			'text' => 'Email подтверждён!'
    		]);	
		
	}


    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    	public function __construct()
    {
        // $this->middleware('auth:api');
        //$this->middleware('signed')->only('verify');
        //$this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
