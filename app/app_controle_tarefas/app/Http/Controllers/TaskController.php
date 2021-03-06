<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// importando a model
use App\Models\Task;

// importando a classe de envio de email
use Illuminate\Support\Facades\Mail;

// importando a classe de template de e-mail
use App\Mail\NewTaskMail;

// importando o laravel-excel
use Excel;

// importando o laravel-dompdf
use PDF;

// importando a classe de exportação para excel
use App\Exports\TaskExport;

class TaskController extends Controller
{

    // definição das validações de cada campo
    private $validationRules =
    [
        'task' => 'required|min:5|max:200',
        'end_date_limit' => 'required|date'
    ];

    // customização das mensagens de erro
    private $validationMessages =
    [
        'required' => 'O campo não pode ser vazio!',
        'task.min' => 'O campo não pode ter menos de 5 caracteres!',
        'task.max' => 'O campo não pode ter mais de 200 caracteres!',
        'date' => 'O campo deve ser uma data!'
    ];

    // foi adicionado o construct para permitir utilização do middleware auth
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // é este middleware que realiza o controle de acesso à rota task
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // obtendo o id do usuário logado
        $user_id = auth()->user()->id;

        // consulta no BD, filtrando pelo usuário logado, ordenando por data limite 
        $tasks = Task::where('user_id', $user_id)->orderBy('end_date_limit', 'desc')->paginate(6);

        // renderiza a view index, passando os resultados da consulta e os parâmetros do request
        // o envio dos parâmetros do request possibilita a persistência dos filtros utilizados na paginação
        return view('task.index', ['tasks' => $tasks, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // renderiza a view create
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validando os dados recebidos do formulário
        $request->validate($this->validationRules, $this->validationMessages);

        // obtendo os dados do usuário logado
        $user = auth()->user();

        // insere os dados no BD
        $task = new Task();
        $task->user_id = $user->id;
        $task->task = $request->get('task');
        $task->end_date_limit = $request->get('end_date_limit');
        $task->save();

        // envia e-mail para ciência do usuário
        Mail::to($user->email)->send(new NewTaskMail($task));

        // redireciona para a rota show
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        // se a tarefa não pertencer ao usuário logado
        if (!($task->user_id == auth()->user()->id)) {

            // renderiza a view forbidden, impedindo a operação
            return view('forbidden');
        }

        // renderiza a view show, passando os resultados da consulta
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // se a tarefa não pertencer ao usuário logado
        if (!($task->user_id == auth()->user()->id)) {

            // renderiza a view forbidden, impedindo a operação
            return view('forbidden');
        }

        // renderiza a view create, passando os resultados da consulta
        return view('task.create', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // se a tarefa não pertencer ao usuário logado
        if (!($task->user_id == auth()->user()->id)) {

            // renderiza a view forbidden, impedindo a operação
            return view('forbidden');
        }

        // validando os dados recebidos do formulário
        $request->validate($this->validationRules, $this->validationMessages);

        // atualiza os dados no BD
        $task->update($request->all());

        // redireciona para a rota show
        return redirect()->route('task.show', ['task' => $task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        // se a tarefa não pertencer ao usuário logado
        if (!($task->user_id == auth()->user()->id)) {

            // renderiza a view forbidden, impedindo a operação
            return view('forbidden');
        }

        // apagando o registro no BD
        $task->delete();

        // redireciona para a rota index
        return redirect()->route('task.index');
    }

    // ação para exportação
    public function export(String $type)
    {

        // se o argumento recebido não for um tipo válido
        if (!in_array($type, ['xlsx', 'csv', 'pdf'])) {
            // redireciona para a rota index
            return redirect()->route('task.index');
        }

        // obtendo o id do usuário logado
        $user_id = auth()->user()->id;

        // obtendo a data e hora atuais
        $now = date("Y-m-d H:i:s");

        // definindo o nome do arquivo de saída
        $filename = "{$now}_tasks_user_{$user_id}.{$type}";

        // exportando o arquivo
        return Excel::download(new TaskExport, $filename);
    }

    // ação para exportação de podf com dompdf
    public function export_pdf()
    {

        // obtendo o id do usuário logado
        $user_id = auth()->user()->id;

        // obtendo a data e hora atuais
        $now = date("Y-m-d H:i:s");

        // definindo o nome do arquivo de saída
        $filename = "{$now}_tasks_user_{$user_id}.pdf";

        // consulta no BD, filtrando pelo usuário logado, ordenando por data limite 
        $tasks = auth()->user()->task()->orderBy('end_date_limit', 'desc')->get();

        // carregando a view e os dados
        $pdf = PDF::loadView('task.pdf', ['tasks' => $tasks]);

        // definindo a página
        // o primeiro argumento é o tamanho
        // o segundo argumento é a orientação (portrait ou landscape)
        $pdf->setPaper('a4', 'portrait');

        // // gera e executa do download do arquivo
        // return $pdf->download($filename);

        // gera e abre o arquivo pelo browser
        return $pdf->stream($filename);
    }
}
