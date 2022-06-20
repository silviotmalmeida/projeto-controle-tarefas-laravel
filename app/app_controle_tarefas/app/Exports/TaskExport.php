<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

// foi feita a inclusão da interface WithHeadings para permitir a exportação dos títulos das colunas
// foi feita a inclusão da interface WithMapping para permitir a customização dos dados da saída
class TaskExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        // consulta no BD, filtrando pelo usuário logado, ordenando por data limite 
        return auth()->user()->task()->orderBy('end_date_limit', 'desc')->get();

        // forma alternativa
        // // obtendo o id do usuário logado
        // $user_id = auth()->user()->id;

        // // consulta no BD, filtrando pelo usuário logado, ordenando por data limite 
        // return Task::where('user_id', $user_id)->orderBy('end_date_limit', 'desc')->get();
    }

    // implementando o método da interface WithHeadings
    public function headings(): array
    {
        // definindo os títulos das colunas
        return [
            'ID da tarefa',
            'Nome da tarefa',
            'Data limite de conclusão',
        ];
    }

    // implementando o método da interface WithMapping
    public function map($task): array
    {
        // ajustando os dados a serem retornados
        return [
            $task->id,
            $task->task,
            // formatando a data
            date('d/m/Y', strtotime($task->end_date_limit)),
        ];
    }
}
