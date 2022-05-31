@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- foi traduzida a mensagem --}}
                <div class="card-header">Favor clicar no link de verificação enviado para o seu e-mail</div>

                <div class="card-body">
                    @if (session('resent'))
                        {{-- foi traduzida a mensagem --}}
                        <div class="alert alert-success" role="alert">
                            Enviamos um novo e-mail com o link de verificação!
                        </div>
                    @endif

                    {{-- foi traduzida a mensagem --}}
                    Antes de prosseguir, favor clicar no link de verificação enviado para o seu e-mail.
                    <br>
                    Se você não recebeu o e-mail com o link de verificação,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        {{-- foi traduzida a mensagem --}}
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para solicitar um novo link de verificação</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
