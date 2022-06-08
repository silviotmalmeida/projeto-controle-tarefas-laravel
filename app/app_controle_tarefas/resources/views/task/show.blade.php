{{-- extende do arquivo base de layout --}}
@extends('layouts.app')

{{-- definindo o conteúdo a ser injetado --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                {{-- inserindo o título --}}
                <div class="card-header">{{ $task->task }}</div>

                <div class="card-body">
                    <fieldset disabled>
                        <div class="mb-3">

                            {{-- inserindo a data --}}
                            <label class="form-label">Data limite conclusão</label>
                            <input type="date" class="form-control" value="{{ $task->end_date_limit }}">
                        </div>
                    </fieldset>

                    {{-- inserindo o botão voltar --}}
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection