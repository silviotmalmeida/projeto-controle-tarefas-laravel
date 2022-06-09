{{-- definindo o componente de formulário de criação e edição de tarefas --}}

{{-- adicionando conteúdo adicional da variável $slot, se houver --}}
{{ $slot }}

{{-- caso o id da tarefa esteja definido, trata-se de uma edição --}}
@if(isset($task->id))
{{-- definindo a rota de destino e o verbo http a ser utilizado pelo formulário --}}
<form method="post" action="{{ route('task.update', $task->id) }}">
    {{-- inserindo o token csrf --}}
    @csrf
    {{-- alterando o verbo http como put --}}
    @method('PUT')
{{-- senão, trata-se de um novo cadastro --}}
@else
{{-- definindo a rota de destino e o verbo http a ser utilizado pelo formulário --}}
<form method="post" action="{{ route('task.store') }}">
    {{-- inserindo o token csrf --}}
    @csrf
@endif

{{-- inserindo os inputs do formulário --}}
{{-- os campos value estão utilizando os dados de $task, caso existam --}}
{{-- os campos value estão utilizando a função old() para preservar os dados inseridos no caso de falha de validação --}}
{{-- em caso de falha de validação, as mensagens do erro serão exibidas abaixo do respectivo input --}}
<div class="mb-3">
    <label class="form-label">Tarefa</label>
    {{-- inserindo o input --}}
    <input type="text" class="form-control" name="task" value="{{ $task->task ?? old('task') }}">
    {{-- inserindo a mensagem de erro referente ao input --}}
    {{$errors->has('task') ? $errors->first('task') : ''}}
</div>
<div class="mb-3">
    <label class="form-label">Data limite conclusão</label>
    {{-- inserindo o input --}}
    <input type="date" class="form-control" name="end_date_limit" value="{{ $task->end_date_limit ?? old('end_date_limit') }}">
    {{-- inserindo a mensagem de erro referente ao input --}}
    {{$errors->has('end_date_limit') ? $errors->first('end_date_limit') : ''}}
</div>
{{-- caso o id da tarefa esteja definido, trata-se de uma edição --}}
@if(isset($task->id))
    {{-- inserindo o button Salvar --}}
    <button type="submit" class="btn btn-primary">Salvar</button>
@else
    {{-- inserindo o button Editar --}}
    <button type="submit" class="btn btn-primary">Cadastrar</button>
@endif
           
<form>