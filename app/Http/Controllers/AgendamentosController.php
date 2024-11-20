<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AgendamentosController extends Controller
{
    public function index()
    {
        $data = [
            'status' => true,
            
        ];

        $agendamentos = Agendamentos::query()
        // ->where("start_on", '>=', new DateTime())
        ->where("agendamentos.status", '1')
        ->leftJoin('campos', 'campos.id', '=', 'agendamentos.campo_id')
        ->orderBy("agendamentos.id", 'desc')
        ->get(['agendamentos.id', 'agendamentos.start_on', 'agendamentos.end_on', 'campos.nome as campo_nome', 'campos.id as campo_id']);

        $data['agendamentos'] = $agendamentos;
        $data['urlsave'] = route("menu.agendamento.save");
        $data['urldestroy'] = route("menu.agendamento.destroy");

        return Inertia::render("Auth/Agendamentos/Listar", $data);
    }
}
