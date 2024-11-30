<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashAgendamentosController extends Controller
{
    public function index() {
        $data = [
            'routegetusers' => route("api.auth.dash.getusers"),
            'routegetcampos' => route("api.auth.dash.getcampos"),
            'routegetagendamentos' => route("api.auth.dash.getagendamentos"),
            'routeapioperationsagendamentos' => route("api.auth.dash.agendamentos.operation")
        ];

        return Inertia::render("Auth/Dashboard/Agendamentos/Index", $data);
    }

    public function save(Request $request)
    {
        $agendamento = new MenuController();

        if ($request->operation == '0') {
            $saveAgendamento = $agendamento->destroy($request, true);
        } else {
            $saveAgendamento = $agendamento->save($request, true);
        }

        $data = [ 
            'status' => $saveAgendamento
        ];

        return response()->json($data);
    }

    public function getagendamentos() {

        $agendamentos = Agendamentos::select("users.name as user", 'campos.nome as campo',"agendamentos.id", 'agendamentos.campo_id', 'agendamentos.user_id', DB::raw('date_format(agendamentos.start_on, "%d/%m/%Y %H:%i:%i") as start_on'), DB::raw('date_format(agendamentos.end_on, "%d/%m/%Y %H:%i:%i") as end_on'), 'agendamentos.created_at', 'agendamentos.updated_at', 'agendamentos.status')
        ->leftJoin("users", 'users.id', '=', 'agendamentos.user_id')
        ->leftJoin("campos", 'campos.id', '=', 'agendamentos.campo_id')->get();

        $data = [
            'agendamentos' => $agendamentos
        ];

        return response()->json($data);
    }
}
