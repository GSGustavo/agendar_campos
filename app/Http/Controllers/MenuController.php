<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Campos;
use DateTime;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        // Fazendo isso pro sintético ficar como primeira opção no select do menu
        $campos = Campos::query()
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

        $operationLog = 0;
        $dataBeforeLog = null;
        $agendamento = new Agendamentos();
        $status = false; // Caiu na validação do status?

        $dataAgendamentos = [];

        foreach (json_decode($request->dates) as $date) {
            $dataAgendamentos[] = [
                'user_id' => 1,
                'campo_id' => 1,
                'date' => $date,
                'init_time' => $request->init_time,
                'end_time' => $request->end_time,
                'status' => 1
            ];

//             select * from agendamentos
// where date = '2024-11-26'
// and '21:00' > init_time
// and '21:00' < end_time 
// or  init_time < '23:00'

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

        $saveAgendamento = false;

        if ($request->id != 0) {
            // $saveAgendamento = $agendamento->update($dataAgendamento);
        } else {
            foreach ($dataAgendamentos as $dataAgendamento) {
                $saveAgendamento = Agendamentos::create($dataAgendamento);
            }
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

        return $dataAgendamento;
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
            ->where("date", '>=', new DateTime())
            ->where("agendamentos.status", '1')
            ->where("agendamentos.campo_id", $request->id)
            ->leftJoin('campos', 'campos.id', '=', 'agendamentos.campo_id')
            ->get(['agendamentos.id', 'agendamentos.init_time', 'agendamentos.end_time', 'agendamentos.date', 'campos.nome as campo_nome']);

        if ($agendamentos) {
            $data['status'] = true;
            $data['agendamentos'] = $agendamentos;
        }


        return json_encode($data);
    }
}
