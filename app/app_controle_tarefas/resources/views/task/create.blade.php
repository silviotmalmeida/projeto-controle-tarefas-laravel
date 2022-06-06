@extends('layouts.app')

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
                        <div class="mb-3">
                            <label class="form-label">Tarefa</label>
                            <input type="text" class="form-control" name="task">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Data limite conclusão</label>
                            <input type="date" class="form-control" name="end_date_limit">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection