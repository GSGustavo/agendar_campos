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
              
                <div class="w-[200px]">
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
            </div>
        </div>

       <agendamento-form action="{{route("menu.agendamento.save")}}">

       </agendamento-form>

        <div class="w-full border-solid border-2 rounded-xl flex flex-col p-5 gap-4">
            <p class="text-center font-black text-xl">Como chegar no campo?</p>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr"
                height="450" loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
