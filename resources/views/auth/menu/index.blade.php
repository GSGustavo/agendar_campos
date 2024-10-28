@extends('layouts.auth.layout')

@section('js')
    <script src="{{ asset('js/auth/menu/main.js') }}"></script>
@endsection

@section('content')
    <div class="flex flex-col gap-10 p-10">
        <div class="mb-5">
            <p class="text-center">14 de outubro, 2024</p>
        </div>
        <div class="flex justify-between">
            <div class="self-center ">
                <h1 class="font-black text-2xl">Olá, João</h1>
            </div>
            <div>
                @php
                    $countries = [
                        [
                            'id' => '1',
                            'nome' => 'Sintético',
                            'maps_link' =>
                                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr',
                        ],
                        [
                            'id' => '2',
                            'nome' => 'Grande',
                            'maps_link' =>
                                'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr',
                        ],
                    ];
                @endphp
                <div class="w-[200px]">
                    <x-bladewind::dropdown placeholder="Campo" name="country" :data="$countries" label_key="nome"
                        value_key="id" />
                </div>
            </div>
        </div>
        @php
            $diasSemana = ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'];

            $colunas = [
                ['D', '1', '1', '1', '1', '1'],
                ['S', '1', '1', '1', '1', '1'],
                ['T', '1', '1', '1', '1', '1'],
                ['Q', '1', '1', '1', '1', '1'],
                ['Q', '1', '1', '1', '1', '1'],
                ['S', '1', '1', '1', '1', '1'],
                ['S', '1', '1', '1', '1', '1'],
            ];
        @endphp
        {{-- <div class="flex items-center">
            <div class="flex flex-col mx-auto items-center w-[300px] gap-4">
           

                <div class="flex justify-between w-full">
                    @foreach ($diasSemana as $dia)
                        <div class="text-gray">
                            {{ $dia }}
                        </div>
                    @endforeach
                </div>
                <div class="flex">
                    @for ($i = 0; $i < 7; $i++)
                        <button class="text-gray border-2 border-primary text-center w-[40px] h-[40px]">
                            0
                        </button>
                    @endfor
                </div>
            </div>
        </div> --}}

        <div class="flex text-center">

            @foreach ($colunas as $coluna)
                <div class="flex flex-col">
                    @foreach ($coluna as $item)
                        @if (is_numeric($item))
                            <button class="w-10 h-10">
                                {{ $item }}
                            </button>
                        @else
                            <div class="w-10 h-10 text-gray">
                                {{ $item }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>


        <div class="w-full">
            <div class="flex justify-between items-center gap-10">
                <input type="text" placeholder="00:00"
                    class="time shadow-lg text-center text-lg p-2 font-black border-2 border-primary h-70 rounded-[10px] w-40" />
                <p>Até</p>
                <input type="text" placeholder="00:00"
                    class="time shadow-lg text-center text-lg p-2 font-black border-2 border-primary h-70 rounded-[10px] w-40" />
            </div>
        </div>
        <div class="items-center flex gap-3 mx-auto hidden">
            <x-bladewind::checkbox color="green" checked="true" label="Definir diferentes horários" />
        </div>
        <div class="mx-auto">
            <button
                class="bg-primary text-white py-2 px-5 rounded-[10px] hover:bg-green  hover:text-black font-black border-2 hover:border-black transition-all duration-100">
                <i class="ri-calendar-line"></i>
                Agendar
            </button>
        </div>

        <div class="w-full border-solid border-2 rounded-xl flex flex-col p-5 gap-4">
            <p class="text-center font-black text-xl">Como chegar no campo?</p>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr"
                height="450" loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
