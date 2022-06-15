{{-- extende do arquivo base de layout --}}
@extends('layouts.app')

{{-- definindo o conteúdo a ser injetado --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">

                    {{-- inserindo o título --}}
                    <div class="row">
                        <div class="col-6">
                            Tarefas
                        </div>

                        {{-- inserindo os links de criação e exportação --}}
                        <div class="col-6">
                            <div class="float-right">
                                <a href="{{route('task.create')}}" class="btn btn-outline-primary mr-3">Novo</a>
                                <a href="{{route('task.export', ['type' => 'xlsx'])}}" class="btn btn-outline-success mr-3">XLSX</a>
                                <a href="{{route('task.export', ['type' => 'csv'])}}" class="btn btn-outline-secondary mr-3">CSV</a>
                                {{-- <a href="{{route('tarefa.exportacao', ['extensao' => 'pdf'])}}" class="mr-3">PDF</a>
                                <a href="{{route('tarefa.exportar')}}" target="_blank">PDF V2</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    {{-- desenhando a tabela com os registros --}}
                    <table class="table">
                        {{-- inserindo o cabeçalho da tabela --}}
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data limite conclusão</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        {{-- inserindo o corpo da tabela --}}
                        <tbody>
                            {{-- desenhando os registros --}}
                            @foreach($tasks as $key => $t)
                                <tr>

                                    {{-- inserindo o id --}}
                                    <th scope="row">{{ $t['id'] }}</th>

                                    {{-- inserindo a tarefa --}}
                                    <td>{{ $t['task'] }}</td>

                                    {{-- inserindo a data formatada --}}
                                    <td>{{ date('d/m/Y', strtotime($t['end_date_limit'])) }}</td>

                                    {{-- inserindo o link de edição --}}
                                    <td><a class="btn btn-secondary" href="{{ route('task.edit', $t['id']) }}">Editar</a></td>
                                    
                                    {{-- inserindo o link de remoção --}}
                                    {{-- como utiliza o verbo http delete, deve-se incluir um form para isto, com id dinâmico, e ativado por um link com javascript --}}
                                    <td>
                                        <form id="form_{{$t['id']}}" method="post" action="{{ route('task.destroy', ['task' => $t['id']]) }}">
                                            {{-- alterando o verbo http como delete --}}
                                            @method('DELETE')
                                            {{-- inserindo o token csrf --}}
                                            @csrf
                                        </form>
                                        {{-- inserindo o link com evento de javascript para submeter o formulário --}}
                                        <a class="btn btn-danger" href="#" onclick="document.getElementById('form_{{$t['id']}}').submit()">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- inserindo os links da paginação --}}
                    <nav>
                        <ul class="pagination">

                            {{-- inserindo o botão voltar --}}
                            <li class="page-item"><a class="page-link" href="{{ $tasks->previousPageUrl() }}">Voltar</a></li>

                            {{-- iterando sobre as páginas do paginator --}}
                            @for($i = 1; $i <= $tasks->lastPage(); $i++)

                                {{-- se o número da iteração atual for igual ao currentPage do paginator, inclui a clase active --}}
                                <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                                    
                                    {{-- inserindo o botão da iteração atual --}}
                                    <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            {{-- inserindo o botão avançar --}}
                            <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
