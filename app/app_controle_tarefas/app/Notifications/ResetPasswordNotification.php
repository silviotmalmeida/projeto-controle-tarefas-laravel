<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    // criando o atributo para o token
    public $token;

    // criando o atributo para o email
    public $email;

    // criando o atributo para o name
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // alterando o construtor para recebimento do token da model User
    public function __construct($token, $email, $name)
    {
        //atribuindo o token
        $this->token = $token;

        //atribuindo o email
        $this->email = $email;

        //atribuindo o name
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // método responsável por construir o email
    public function toMail($notifiable)
    {

        // montando a url
        $url = env('APP_URL') . '/password/reset/' . $this->token . '?email=' . $this->email;

        // obtendo o tempo de expiração do token
        $minutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        // customizando os campos do email
        return (new MailMessage)
            ->subject(env('APP_NAME') . ' - Alteração de Senha')
            ->greeting('Olá ' . $this->name . "!")
            ->line('Você solicitou a alteração de senha do ' . env('APP_NAME'))
            ->action('Clique aqui para alterar a senha', $url)
            ->line('Este link vai expirar em ' . $minutes . ' minutos.')
            ->line('Caso você não tenha solicitado alteração de senha, nenhuma ação é necessária.')
            ->salutation('Até breve!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
