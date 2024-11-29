<?php

namespace App\Http\Controllers;

use App\Models\Campos;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CamposController extends Controller
{
    public function index() {

        $data = [
            'routegetcampos' => route("api.auth.dash.getcampos"),
            'routeapioperationscampos' => route("api.auth.dash.campos.operation")
        ];

        return Inertia::render("Auth/Dashboard/Campos/Index", $data);
    }


    public function getcampos() {

        $campos = Campos::select("id", 'nome', 'maps_link', 'created_at', 'updated_at')->get();

        $data = [
            'campos' => $campos
        ];

        return response()->json($data);
    }
}
