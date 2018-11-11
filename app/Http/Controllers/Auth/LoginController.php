<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\MultiChainInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use MultiChain;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * @var \App\Repositories\MultiChainInterface
     */
    protected $multichain;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\MultiChainInterface $multichain
     * @return void
     */
    public function __construct(MultiChainInterface $multichain)
    {
        $this->middleware('guest')->except('logout');
        $this->multichain = $multichain;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        //Fetch data by email
        $user = $this->multichain->getUserCredentialByEmail($request->email);
        if (!$user)
            return redirect()->back()->withErrors('These credentials do not match our records.')->withInput();

        //Get the hashed value
        $hashedValue = hex2bin($user[0]['data']);

        //Get the address by decrypting it using the input password
        $address = aes_decrypt($hashedValue,$request->password);

        //Check if the input password is correct
        if (!$address)
            return redirect()->back()->withErrors('These credentials do not match our records.')->withInput();

        //Get the stream name/id from the general table using the address
        $streamItem = $this->multichain->getUserStreamIdByAddress($address);
        $userStreamId = hex2bin($streamItem[0]['data']);

        //Get the user data using the stream id
        $user = $this->multichain->getStreamItems($userStreamId);

        dd('Success!',$user);
    }
}
