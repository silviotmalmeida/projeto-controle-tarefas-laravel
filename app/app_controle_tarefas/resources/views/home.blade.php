@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- traduzindo para o português --}}
                <div class="card-header">{{ __('Painel de avisos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- traduzindo para o português --}}
                    {{ __('Você entrou no sistema!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
