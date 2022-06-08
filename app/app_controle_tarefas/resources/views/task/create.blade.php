{{-- extende do arquivo base de layout --}}
@extends('layouts.app')

{{-- definindo o conteúdo a ser injetado --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                {{-- inserindo o título --}}
                <div class="card-header">Adicionar tarefa</div>

                <div class="card-body">

                    {{-- inserindo o form de criação --}}
                    <form method="post" action="{{ route('task.store') }}">

                        {{-- inserindo o token csrf --}}
                        @csrf

                        {{-- inserindo os inputs do formulário --}}
                        {{-- os campos value estão utilizando a função old() para preservar os dados inseridos no caso de falha de validação --}}
                        {{-- em caso de falha de validação, as mensagens do erro serão exibidas abaixo do respectivo input --}}
                        <div class="mb-3">
                            <label class="form-label">Tarefa</label>
                            {{-- inserindo o input --}}
                            <input type="text" class="form-control" name="task" value="{{ old('task') }}">
                            {{-- inserindo a mensagem de erro referente ao input --}}
                            {{$errors->has('task') ? $errors->first('task') : ''}}
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data limite conclusão</label>
                            {{-- inserindo o input --}}
                            <input type="date" class="form-control" name="end_date_limit" value="{{ old('end_date_limit') }}">
                            {{-- inserindo a mensagem de erro referente ao input --}}
                            {{$errors->has('end_date_limit') ? $errors->first('end_date_limit') : ''}}
                        </div>
                        {{-- inserindo o button --}}
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection