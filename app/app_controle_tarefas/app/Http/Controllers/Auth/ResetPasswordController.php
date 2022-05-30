<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // sobrescrevendo as regras de validação
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            // este campo possui a regra confirmed, que verifica se está igual ao input de name=password_confirmation            
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
