<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UsersController extends Controller
{
	public function index()
	{
		$data = [
			'routegetusers' => route("api.auth.dash.getusers"),
			'routeapioperationsusers' => route("api.auth.dash.operation")
		];

		return Inertia::render("Auth/Dashboard/Users/Index", $data);
	}

	public function getusers()
	{

		$users = User::select(
			"id",
			DB::Raw("CONCAT(name, ' ', lastname) AS nome_completo"),
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

		// atributos obrigatorios para o post
		// id do usuário

		// 0 status
		// atributos:
		// "status"

		// 1 criar
		// 2 editar



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
		}


		return json_encode($data);
	}
}
