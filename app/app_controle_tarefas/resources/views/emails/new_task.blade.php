@component('mail::message')
# {{ $task }}

Data limite de conclusão: {{ $end_date_limit }}

@component('mail::button', ['url' => $url])
Clique aqui para ver a tarefa
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
