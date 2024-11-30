<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetTokens;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $data = [
            'routegetusers' => route("api.auth.dash.getusers"),
            'routeapioperationsusers' => route("api.auth.dash.operation"),
            'routeapiresetpass' => route("api.auth.admin.resetpassword")
        ];

        return Inertia::render("Auth/Dashboard/Users/Index", $data);
    }

    public function getusers()
    {

        $users = User::select(
            "id",
            'name',
            'lastname',
            DB::raw('CONCAT(name, \' \', lastname) as full_name'),
            'email',
            'is_admin',
            'status',

            // Estou usando cast la no model dos usuários para formatar as colunas de datas
            'created_at',
            'updated_at'
        )->get();




        return json_encode($users);
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

        $operation = $request->operation;





        if ($operation == 0) {
            $status = $request->status;

            $user = User::find($request->id);

            if ($user->is_admin == 0) {
                $dataUser = [
                    'id' => $request->id,
                    'status' => $status
                ];


                $saveUser = $user->update($dataUser);

                if ($saveUser) {
                    $data['status'] = true;
                    $data['error'] = '';
                }
            } else {
                $data['error'] = 'Admins não podem sofrer alterações de status!';
            }
        } else if ($operation == 1) {
            $user = User::find($request->id);

            $dataUser = [
                'id' => $request->id,
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'is_admin' => $request->is_admin
            ];


            $saveUser = $user->update($dataUser);

            if ($saveUser) {
                $data['status'] = true;
                $data['error'] = '';
            }
        } else if ($operation == 2) {
            $request->validate(['email' => 'required|email']);
 
            $status = Password::sendResetLink(
                $request->only('email')
            );


            $resetSave = $status == Password::RESET_LINK_SENT;

            if (!$resetSave) {
                $data['error'] = __($status);
            } 

            


            $data['status'] = $resetSave;
        }


        return json_encode($data);
    }
}
