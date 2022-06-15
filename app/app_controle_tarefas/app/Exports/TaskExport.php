<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class TaskExport implements FromCollection
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
}
