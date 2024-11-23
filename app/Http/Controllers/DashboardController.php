<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {

        $data = [
            'routeusers' => route('users.index'),
       
        ];

        return Inertia::render('Auth/Dashboard/Index', $data);
    }
}
