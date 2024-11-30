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

    public function operation(Request $request)
    {
        // Rota para inativar, ativar, criar, editar usuários

        // atributos obrigatorios para o post, exceto em caso de novo usuário
        // id do usuário

        // 0 status
        // atributos:
        // "status"

        // 1 criar/editar

        // 2 reset password

        $data = [
            'status' => false,
            'error' => "Algo deu errado, tente novamente mais tarde!"
        ];


        $saveCampo = false;

        $operation = $request->operation;

        if ($operation == 0) {
            $status = $request->status;

            $campo = Campos::find($request->id);

            $dataCampo = [
                'id' => $request->id,
                'status' => $status
            ];

            $saveCampo = $campo->update($dataCampo);

            if ($saveCampo) {
                $data['status'] = true;
                $data['error'] = '';
            }
   
        } else if ($operation == 1) {
            $campo = new Campos();

            $dataCampo = [
                'nome' => $request->nome,
                'maps_link' => $request->maps_link
            ];

            if($request->id) {
                $dataCampo['id'] = $request->id;

                $campo = Campos::find($request->id);

                $saveCampo = $campo->update($dataCampo);

            } else {
                $saveCampo = $campo->create($dataCampo);
            }


            if ($saveCampo) {
                $data['status'] = true;
                $data['error'] = '';
            }
        } 


        return json_encode($data);
    }


    public function getcampos() {

        $campos = Campos::select("id", 'nome', 'maps_link', 'status', 'created_at', 'updated_at')->get();

        $data = [
            'campos' => $campos
        ];

        return response()->json($data);
    }
}
