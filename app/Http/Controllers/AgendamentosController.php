<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AgendamentosController extends Controller
{
    public function index()
    {
        $data = [
            'status' => true
        ];

        $agendamentos = Agendamentos::query()->where("user_id", Auth::user()->id)->get();

        $data['agendamentos'] = $agendamentos;
        

        return Inertia::render("Auth/Agendamentos/Listar", $data);
    }
}
