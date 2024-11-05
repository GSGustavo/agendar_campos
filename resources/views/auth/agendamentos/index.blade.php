@extends('layouts.auth.layout')

@section('js')
    <script src="{{ asset('js/auth/menu/main.js') }}"></script>
@endsection

@section('content')
    <div class="flex flex-col gap-10 p-10">
        <div class="mb-5">
            <p class="text-center">14 de outubro, 2024</p>
        </div>
        <div class="flex flex-col justify-center">
          
                <h1 class="font-black text-2xl">Olá, João</h1>
            <h1 class="font-black text-2xl">
                Seus Agendamentos
            </h1>
           
        </div>

       
    </div>
@endsection
