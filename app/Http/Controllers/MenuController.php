<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use App\Models\Campos;
use App\Models\User;
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

        $user = User::find(auth()->user()->id);

        $permitiragendamento = $user->cpf != null ? true : false;

        $data = [
            'campos' => $campos,
            'apigetcampo' => route("api.auth.menu.getcampo"),
            'apigetagendamentos' => route("api.auth.menu.getagendamentos"),
            'permitiragendamento' => $permitiragendamento
        ];

        return Inertia::render('Auth/Menu', $data);
    }

    public function save(Request $request, $internal = false)
    {

        // erros
        // 0 = erro de servidor
        // 1 = sem disponibilidade
        $data = [
            'status' => false,
            'error' => 0
        ];


        $agendamento = new Agendamentos();
     

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

        $saveAgendamento = false;

        // Vai cair no if abaixo caso a data e o horário estiver livre
        if (!$conflito) {
            
            $dataAgendamento = [
                'start_on' => $startOn,
                'end_on' => $endOn,
                'campo_id' => $campoId,
                'user_id' => Auth::user()->id
            ];

       

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


        if ($internal) {
            return $saveAgendamento;
        } else {
            return json_encode($data);
        }
        
    }

    public function destroy(Request $request, $internal = false)
    {
        $data = [
            'status' => false
        ];

        $agendamento = Agendamentos::find($request->id);
        $saveAgendamento = false;
        $conflito = false;
        $status = 0;

        if ($internal) {
            $status = $request->status;
        }

        if ($agendamento) {
            if ($status != 0) {

                $startOn = Carbon::parse($agendamento->start_on); // Converte para um objeto Carbon
                $endOn = Carbon::parse($agendamento->end_on); // Converte para um objeto Carbon

                $conflito = Agendamentos::where('campo_id', $agendamento->campo_id)
                ->where('status', 1)
                ->whereNot("id", $agendamento->id)
                ->where(function ($query) use ($startOn, $endOn) {
                    $query->where(function ($q) use ($startOn, $endOn) {
                        // Verifica sobreposição
                        $q->where('start_on', '<', $endOn)
                            ->where('end_on', '>', $startOn);
                    });
                })->exists();
            }

            if (!$conflito or $status == 0) {
                $dataAgendamento['id'] = $request->id;
                $dataAgendamento['status'] = $status;
    
                $saveAgendamento = $agendamento->update($dataAgendamento);
            }
           

            if ($saveAgendamento) {
                $data['status'] = true;
            }
        }

        if ($internal) {
            return $saveAgendamento;
        } else {
            return json_encode($data);
        }
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
