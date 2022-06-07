<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// importando a model
use App\Models\Task;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $end_date_limit;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task->task;

        // formatando a data para exibição
        $this->end_date_limit = date('d/m/Y', strtotime($task->end_date_limit));
        $this->url = env('APP_URL') . '/task/' . $task->id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_task')
        // ajustando o assunto do e-mail
        ->subject('Nova tarefa criada');
    }
}
