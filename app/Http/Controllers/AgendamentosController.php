<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgendamentosController extends Controller
{
        public function index()
        {
                return Inertia::render("Auth/Agendamentos/Listar");
        }
}
