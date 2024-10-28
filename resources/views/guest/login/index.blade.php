@extends('layouts.guest.layout')

@section('js')
    @vite('resources/js/app.js')
@endsection

@section('css')
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="h-max flex justify-center">
        <div class="flex flex-col w-[350px] xl:w-[500px] ">
            <div>

            </div>
            <div class="mb-5">
                <div class="text-center p-5">
                    <h3 class="h3 text-2xl font-black">
                        Fazer Login
                    </h3>
                </div>
            </div>
            <div class="">
                <div class="">

                    <div class="mb-3 flex flex-col">
                        <label htmlFor="formGroupExampleinput" class="form-label">
                            Email: <span class="text-danger ">*</span>
                        </label>

                        <input type="text" class="form-control focus:border-b-5 border-black transition-all duration-150"
                            id="email" placeholder="Ex: joaosilva@gmail.com">
                        </input>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <div class="mb-3 flex flex-col">
                        <label htmlFor="formGroupExampleinput" class="form-label">Senha: <span
                                class="text-danger ">*</span></label>

                        <input type="password" class="form-control focus:border-b-5 border-black" id="password"
                            placeholder="Senha">
                        </input>

                    </div>
                </div>
            </div>
            <div class="my-5">
                <div class=" text-center">
                    
                    <x-primary-button class="bg-transparent hover:text-black hover:border-black hover:border-2 transition-all duration-100 bg-black text-white">
                        Entrar
                    </x-primary-button>
                    <x-bladewind::button>Save User</x-bladewind::button>
                </div>
            </div>
            <div class="my-5">
                <p class="text-center">
                    Ou se deseja apenas ver a disponibilidade sem
                    entrar em sua conta, clique no botão abaixo.
                </p>
            </div>
            <div class="my-5">
                <div class=" text-center">
                    <button
                        class="hover:bg-transparent hover:text-black hover:border-black hover:border-2 transition-all duration-100">
                        <i class="ri-calendar-2-line" />
                        Disponibilidade
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
