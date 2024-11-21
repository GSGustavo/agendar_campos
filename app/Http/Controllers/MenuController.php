<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Campos;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        // Fazendo isso pro sintético ficar como primeira opção no select do menu
        $campos = Campos::query()
        ->where("status", '1')
            ->orderBy("id", "asc")
            ->get(['id', 'nome']);



        $data = [
            'campos' => $campos,
            'apigetcampo' => route("api.auth.menu.getcampo"),
            'apigetagendamentos' => route("api.auth.menu.getagendamentos"),
        ];

        return Inertia::render('Auth/Menu', $data);
    }

    public function save(Request $request)
    {

        // erros
        // 0 = erro de servidor
        // 1 = sem disponibilidade
        $data = [
            'status' => false,
            'error' => 0
        ];

        $operationLog = 0;
        $dataBeforeLog = null;
        $agendamento = new Agendamentos();
        $status = false; // Caiu na validação do status?

        // Tentando achar um agendamento com base no que foi enviado via request
        $campoId = $request->campo_id; // ID do campo
        $startOn = Carbon::parse($request->start_on); // Converte para um objeto Carbon
        $endOn = Carbon::parse($request->end_on); // Converte para um objeto Carbon


        // // SELECT *
        // // FROM agendamentos
        // // WHERE campo_id = :campo_id
        // //   AND status = 1
        // //   AND (
        // //         :start_on < end_on
        // //     AND :end_on > start_on
        // //       );

        $conflito = Agendamentos::where('campo_id', $campoId)
            ->where('status', 1)
            ->where(function ($query) use ($startOn, $endOn) {
                $query->where(function ($q) use ($startOn, $endOn) {
                    // Verifica sobreposição
                    $q->where('start_on', '<', $endOn)
                        ->where('end_on', '>', $startOn);
                });
            });
        
        // Esse if é para quando vai editar, e talvez na consulta fique só o próprio agendamento que a pessoa esta editando, ai para evitar
        // do conflito vir como true, tiramos o id do agendamento que a pessoa esta editando
        if ($request->id) {
            $conflito = $conflito->where("id", '<>', $request->id);
        }

        $conflito = $conflito->exists();

        // Vai cair no if abaixo caso a data e o horário estiver livre
        if (!$conflito) {
            
            $dataAgendamento = [
                'start_on' => $startOn,
                'end_on' => $endOn,
                'campo_id' => $campoId,
                'user_id' => Auth::user()->id
            ];

            $saveAgendamento = false;

            if ($request->id != 0) {
                $dataAgendamento['id'] = $request->id;
                $agendamento = Agendamentos::find($request->id);

                $saveAgendamento = $agendamento->update($dataAgendamento);

           

            } else {

                $saveAgendamento = Agendamentos::create($dataAgendamento);
            }

            if ($saveAgendamento) {
                $data['status'] = true;
            }
        } else {
            $data['error'] = 1;
        }




        if ($request->id != 0) {

            $operationLog = 1;
            $agendamento = Agendamentos::find($request->id);

            // $dataBeforeLog = [
            //     'user_id' => $agendamento->user_id,
            //     'campo_id' => $agendamento->campo_id,
            //     'date' => $agendamento->date,
            //     'init_time' => $agendamento->init_time,
            //     'final_time' => $agendamento->final_time,
            //     'status' => $agendamento->status
            // ];

            // $pagamentos = Pagamentos::query()->where("mensalidade_id", $agendamento->id)->get();
            // if (!$pagamentos->isEmpty()) {

            //     $status = true;
            //     $dataAgendamento['status'] = $request->status == 0 ? $dataBeforeLog['status'] : $request->status;
            // }
        }



        // if ($saveAgendamento) {
        //     $mensagem = "Mensalidade salva com sucesso!";

        //     if ($status) {
        //         $mensagem = "Mensalidade salva, porém não pode ser desativada!";
        //     }

        //     $alert = Alert::i(Alert::SUCCESS, $mensagem);

        //     MensalidadesLog::create([
        //         "user_id" => auth()->user()->id,
        //         'operation' => $operationLog,
        //         "mensalidade_id" => $request->id == 0 ? $saveAgendamento->id : $request->id,
        //         "before" => $dataBeforeLog ? json_encode($dataBeforeLog) : null,
        //         "after" => json_encode($dataAgendamento)
        //     ]);
        // }

        return json_encode($data);
    }

    public function destroy(Request $request)
    {
        $data = [
            'status' => false
        ];

        $agendamento = Agendamentos::find($request->id);

        if ($agendamento) {
            $dataAgendamento['id'] = $request->id;
            $dataAgendamento['status'] = 0;

            $saveAgendamento = $agendamento->update($dataAgendamento);

            if ($saveAgendamento) {
                $data['status'] = true;
            }
        }

        return json_encode($data);
    }


    public function getcampo(Request $request)
    {
        $data = [
            'status' => false
        ];

        $campo = Campos::find($request->id);

        if ($campo) {
            $data['status'] = true;
            $data['maps_link'] = $campo->maps_link;
        }

        return json_encode($data);
    }

    public function getagendamentos(Request $request)
    {
        $data = [
            'status' => false
        ];

        $agendamentos = Agendamentos::query()
            ->where("start_on", '>=', new DateTime())
            ->where("agendamentos.status", '1')
            ->where("agendamentos.campo_id", $request->id)
            ->leftJoin('campos', 'campos.id', '=', 'agendamentos.campo_id')
            ->get(['agendamentos.id', 'agendamentos.start_on', 'agendamentos.end_on', 'campos.nome as campo_nome']);

        if ($agendamentos) {
            $data['status'] = true;
            $data['agendamentos'] = $agendamentos;
        }


        return json_encode($data);
    }
}
