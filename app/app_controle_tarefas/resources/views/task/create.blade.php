{{-- extende do arquivo base de layout --}}
@extends('layouts.app')

{{-- definindo o conteúdo a ser injetado --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                {{-- caso o id da tarefa esteja definido, trata-se de uma edição --}}
                @if(isset($task->id))
                    <div class="card-header">Editar tarefa</div>
                {{-- senão, trata-se de um novo cadastro --}}
                @else
                    <div class="card-header">Adicionar tarefa</div>
                @endif                

                <div class="card-body">

                    {{-- renderizando a mensagem se tiver sido injetada --}}
                    {{ $msg ?? '' }}

                    {{-- adicionando o componente de formulário de criação e edição --}}
                    {{-- caso o id da tarefa esteja definido, trata-se de uma edição --}}
                    @if(isset($task->id))
                        @component('task._components._create_update_form', ['task' => $task])@endcomponent
                    {{-- senão, trata-se de um novo cadastro --}}
                    @else
                        @component('task._components._create_update_form')@endcomponent
                    @endif  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection