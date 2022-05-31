<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// importando as notificações
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;

// alterado para implementar MustVerifyEmail para exigir verificação do email cadastrado
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // sobrescrevendo a função padrão de envio de e-mail de reset de senha
    public function sendPasswordResetNotification($token)
    {

        // utilizando a notificação
        $this->notify(new ResetPasswordNotification($token, $this->email, $this->name));
    }

    // sobrescrevendo a função padrão de envio de e-mail de verificação de e-mail
    public function sendEmailVerificationNotification()
    {

        // utilizando a notificação
        $this->notify(new VerifyEmailNotification($token, $this->email, $this->name));
    }
}
