{{-- extende do arquivo base de layout --}}
@extends('layouts.app')

{{-- definindo o conteúdo a ser injetado --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                {{-- exibindo o título --}}
                <div class="card-header">Acesso negado</div>

                {{-- exibindo a mensagem --}}
                <div class="card-body">
                    Desculpe. Você não tem acesso a esse recurso.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection