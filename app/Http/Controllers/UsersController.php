<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index() {

        $data = [
            'routegetusers' => route("api.auth.dash.getusers")
        ];

        return Inertia::render("Auth/Dashboard/Users/Index", $data);
    }

    public function getusers() {


        $users = User::query()->get(["id", DB::Raw("CONCAT(name, ' ', lastname) AS nome_completo"), 'email', 'created_at', 'updated_at', 'is_admin', 'status']);

        return json_encode($users);
    }
}
