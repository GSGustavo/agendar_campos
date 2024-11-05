<?php

namespace App\Http\Controllers;

use App\Models\Agendamentos;
use Illuminate\Http\Request;

class AgendamentosController extends Controller
{
        public function index()
        {
                return view("auth.agendamentos.index");
        }
}
