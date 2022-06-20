<html>
    <head>

        {{-- ativando o suporte a utf-8 --}}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        {{-- definindo os estilos a serem utilizados --}}
        <style>
            .page-break {
                page-break-after: always;
            }

            .titulo {
                border:1px;
                background-color:#c2c2c2;
                text-align:center;
                width:100%;
                text-transform:uppercase;
                font-weight:bold;
                margin-bottom:25px;
            }

            table th {
                text-align:left;
            }
        </style>
    </head>

    <body>

        {{-- inserindo o título --}}
        <div class="titulo">Lista de tarefas</div>

        {{-- inserindo a tabela com os dados --}}
        <table style="width:100%">

            {{-- títulos das colunas --}}
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarefa</th>
                    <th>Data limite conclusão</th>
                </tr>
            </thead>

            {{-- dados das colunas --}}
            <tbody>

                {{-- iterando sobre o array de tasks --}}
                @foreach($tasks as $key => $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->task }}</td>

                        {{-- formatando a data --}}
                        <td>{{ date('d/m/Y', strtotime($task->end_date_limit)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>
        <h2>Página 2</h2>

        <div class="page-break"></div>
        <h2>Página 3</h2>

        <div class="page-break"></div>
        <h2>Página 4</h2>
    </body>
</html>