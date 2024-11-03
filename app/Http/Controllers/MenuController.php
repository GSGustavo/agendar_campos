<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('auth.menu.index');
    }

    public function save(Request $request)
    {

        $operationLog = 0;
        $dataBeforeLog = null;
        $agendamento = new Agendamentos();
        $status = false; // Caiu na validação do status?

        // $dataAgendamento = [
        //     'user_id' => 1,
        //     'campo_id' => 1,
        //     'date' => $request->dates,
        //     'init_time' => $request->init_time,
        //     'end_time' => $request->end_time,
        //     'status' => 1
        // ];

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

        // if ($request->id != 0) {
        //     $saveAgendamento = $agendamento->update($dataAgendamento);
        // } else {
        //     $saveAgendamento = Agendamentos::create($dataAgendamento);
            
        // }

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

        return $request;
    }
}
