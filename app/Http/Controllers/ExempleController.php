<?php

// namespace App\Http\Controllers\dashboard;

// use App\Http\Controllers\Controller;
// use App\Http\Controllers\Util\Alert;
// use App\Models\Academicos;
// use App\Models\AnoLetivo;
// use App\Models\Cidades;
// use App\Models\Faculdades;
// use App\Models\FaculdadesLog;
// use App\Models\Mensalidades;
// use App\Models\MensalidadesLog;
// use App\Models\Pagamentos;
// use App\Models\Pontos;
// use App\Models\User;
// use Illuminate\Database\Eloquent\Casts\Json;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

// use function PHPUnit\Framework\isNull;

// class MensalidadesController extends Controller
// {
//     public function index()
//     {

//         $mensalidades = Mensalidades::query()
//             ->leftJoin("ano_letivo", "ano_id", "=", "ano_letivo.id")
//             ->leftJoin("faculdades", "faculdade_id", "=", "faculdades.id");


//         if (auth()->user()->is_admin != 1) {
//             $mensalidades = $mensalidades->where("faculdades.user_id", auth()->user()->id);
//         }

//         $mensalidades = $mensalidades->select('mensalidades.*', "ano_letivo.ano as ano", 'faculdades.nome as faculdade', "faculdades.user_id as lider_id")
//             ->orderBy('mensalidades.created_at', 'desc')
//             ->paginate(20);


//         $data = [
//             'mensalidades' => $mensalidades
//         ];


//         return view("dashboard.lider.mensalidades.listar", $data);
//     }


//     public function manage($id = 0)
//     {

//         $mensalidade = null;
//         $faculdades = Faculdades::query()->where("status", '1')->get();
//         $anos = AnoLetivo::query()->where("status", '1')->get();
//         $data = [
//             'faculdades' => $faculdades,
//             'anos' => $anos,
//             'mensalidade' => $mensalidade
//         ];

//         if ($id != 0) {
//             $mensalidade = Mensalidades::find($id);

//             $addZeros = [
//                 'salario_motorista',
//                 'valor_arredondar',
//                 'valor_combustivel',
//                 'valor_adicional',
//                 'valor_retirado',
//                 'meia_arredondar',
//                 'valor',
//                 'meia'
//             ];

//             foreach ($addZeros as $value) {
//                 if (isset($mensalidade->$value)) {
//                     $mensalidade->$value = number_format($mensalidade->$value, 2, ".", "");
//                 }

//             }
//             $data['mensalidade'] = $mensalidade;
//         }

//         return view("dashboard.lider.mensalidades.cadastrar", $data);
//     }


//     public function save(Request $request)
//     {

//         // dd($request);
//         $alert = Alert::i(Alert::DANGER, "Algo deu errado, tente novamente!");

//         $operationLog = 0;
//         $dataBeforeLog = null;
//         $mensalidade = new Mensalidades();
//         $status = false; // Caiu na validação do status?


//         $dataMensalidade = [
//             'descricao' => "" . $request->descricao . "",
//             'user_id' => auth()->user()->id,
//             "faculdade_id" => $request->faculdade_id,
//             "valor" => $request->valor,
//             "valor_arredondar" => $request->valor_arredondar,
//             "meia" => $request->meia, # x
//             "meia_arredondar" => $request->meia_arredondar,
//             "tot_alunos" => $request->tot_alunos,
//             "tot_ultimo_semestre" => $request->tot_ultimo_semestre,  # x
//             "ano_id" => $request->ano_id,
//             "mes_inicio" => $request->mes_inicio,
//             "mes_termino" => $request->mes_termino,
//             "valor_combustivel" => $request->valor_combustivel,
//             "litros_combustivel" => $request->litros_combustivel,
//             "total_combustivel" => $request->total_combustivel,
//             "dias_letivos" => $request->dias_letivos,
//             "salario_motorista" => $request->salario_motorista,
//             "valor_adicional" => $request->valor_adicional, # x
//             "adicional_descricao" => $request->adicional_descricao, # x
//             "valor_retirado" => $request->valor_retirado, # x
//             "retirado_descricao" => $request->retirado_descricao, # x
//             "total" => $request->total,
//             'status' => $request->status
//         ];

//         if ($request->id != 0) {

//             $operationLog = 1;
//             $mensalidade = Mensalidades::find($request->id);

//             $dataBeforeLog = [
//                 'descricao' => $mensalidade->descricao,
//                 'user_id' => $mensalidade->user_id,
//                 "faculdade_id" => $mensalidade->faculdade_id,
//                 "valor" => $mensalidade->valor,
//                 "meia" => $mensalidade->meia, # x
//                 "tot_alunos" => $mensalidade->tot_alunos,
//                 "tot_ultimo_semestre" => $mensalidade->tot_ultimo_semestre,  # x
//                 "ano_id" => $mensalidade->ano_id,
//                 "mes_inicio" => $mensalidade->mes_inicio,
//                 "mes_termino" => $mensalidade->mes_termino,
//                 "valor_combustivel" => $mensalidade->valor_combustivel,
//                 "litros_combustivel" => $mensalidade->litros_combustivel,
//                 "total_combustivel" => $mensalidade->total_combustivel,
//                 "dias_letivos" => $mensalidade->dias_letivos,
//                 "salario_motorista" => $mensalidade->salario_motorista,
//                 "valor_adicional" => $mensalidade->valor_adicional, # x
//                 "adicional_descricao" => $mensalidade->adicional_descricao, # x
//                 "valor_retirado" => $mensalidade->valor_retirado, # x
//                 "retirado_descricao" => $mensalidade->retirado_descricao, # x
//                 "total" => $mensalidade->total,
//                 'status' => $mensalidade->status,
//                 "valor_arredondar" => $mensalidade->valor_arredondar,
//                 "meia_arredondar" => $mensalidade->meia_arredondar,
//             ];

//             $pagamentos = Pagamentos::query()->where("mensalidade_id", $mensalidade->id)->get();
//             if (!$pagamentos->isEmpty()) {

//                 $status = true;
//                 $dataMensalidade['status'] = $request->status == 0 ? $dataBeforeLog['status'] : $request->status;
//             }
//         }

//         $saveMensalidade = false;

//         if ($request->id != 0) {
//             $saveMensalidade = $mensalidade->update($dataMensalidade);
//         } else {
//             $saveMensalidade = Mensalidades::create($dataMensalidade);
//             dd($saveMensalidade);
//         }

//         if ($saveMensalidade) {
//             $mensagem = "Mensalidade salva com sucesso!";

//             if ($status) {
//                 $mensagem = "Mensalidade salva, porém não pode ser desativada!";
//             }

//             $alert = Alert::i(Alert::SUCCESS, $mensagem);

//             MensalidadesLog::create([
//                 "user_id" => auth()->user()->id,
//                 'operation' => $operationLog,
//                 "mensalidade_id" => $request->id == 0 ? $saveMensalidade->id : $request->id,
//                 "before" => $dataBeforeLog ? json_encode($dataBeforeLog) : null,
//                 "after" => json_encode($dataMensalidade)
//             ]);
//         }

//         return redirect()->route("mensalidades")->with('alert', $alert);
//     }

//     public function alter(Request $request)
//     {


//         $mensalidade = Faculdades::find($request->id);

//         $data = [
//             'status' => false,
//             "message" => "Erro: faculdade em uso ou erro interno!"
//         ];


//         if ($mensalidade) {

//             $id = $mensalidade->id;

//             $dataBeforeAfterLog = [
//                 'nome'  => $mensalidade->nome,
//                 'cidade_id'  => $mensalidade->cidade_id,
//                 "status" => $mensalidade->status,
//                 "user_id" => $mensalidade->user_id
//             ];

//             $academicos = Academicos::query()->where("faculdade_id", $id)->get();
//             $pontos = Pontos::query()->where("faculdade_id", $id)->get();
//             if ($academicos->isEmpty() and $pontos->isEmpty()) {
//                 $alter = $mensalidade->update(
//                     [
//                         'status' => $request->action
//                     ]
//                 );
//                 if ($alter) {
//                     $data = [
//                         'status' => true,
//                         "id" => $id,
//                         "message" => "Faculdade alterada com sucesso"
//                     ];

//                     $dataMensalidade = [
//                         'nome'  => $mensalidade->nome,
//                         'cidade_id'  => $mensalidade->cidade_id,
//                         "status" => $request->action,
//                         "user_id" => $mensalidade->user_id
//                     ];

//                     FaculdadesLog::create([
//                         "user_id" => auth()->user()->id,
//                         'operation' => 1,
//                         "faculdade_id" => $id,
//                         "before" => json_encode($dataBeforeAfterLog),
//                         "after" => json_encode($dataMensalidade)
//                     ]);
//                 }
//             }
//         }

//         return json_encode($data);
//     }
// }
