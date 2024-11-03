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

        dd($request);

        $operationLog = 0;
        $dataBeforeLog = null;
        $mensalidade = new Agendamentos();
        $status = false; // Caiu na validação do status?


        $dataAgendamento = [
            'user_id' => 1,
            'campo_id' => 1,
            'date' => $request->date,
            'init_time' => $request->init_time,
            'final_time' => $request->final_time,
            'status' => 1
        ];

        if ($request->id != 0) {

            $operationLog = 1;
            $mensalidade = Agendamentos::find($request->id);

            $dataBeforeLog = [
                'user_id' => $mensalidade->user_id,
                'campo_id' => $mensalidade->campo_id,
                'date' => $mensalidade->date,
                'init_time' => $mensalidade->init_time,
                'final_time' => $mensalidade->final_time,
                'status' => $mensalidade->status
            ];

            // $pagamentos = Pagamentos::query()->where("mensalidade_id", $mensalidade->id)->get();
            // if (!$pagamentos->isEmpty()) {

            //     $status = true;
            //     $dataAgendamento['status'] = $request->status == 0 ? $dataBeforeLog['status'] : $request->status;
            // }
        }

        $saveAgendamento = false;

        if ($request->id != 0) {
            $saveAgendamento = $mensalidade->update($dataAgendamento);
        } else {
            $saveAgendamento = Agendamentos::create($dataAgendamento);
            dd($saveAgendamento);
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

        return redirect()->route("auth.menu.index");
    }
}
