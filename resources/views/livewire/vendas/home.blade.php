@extends('layouts.app')

@section('content')
    <div x-data="{ open: false }"  x-cloak class=" flex justify-center mt-4 ">
        <button @click="open = ! open"
                x-bind:class="[open ? '': 'animate-pulse' ]"
                class="text-2xl font-medium rounded-full bg-indigo-600 hover:bg-indigo-500 focus:border-gray-800 text-white p-2.5">
            <x-icon name="clipboard-check" class="w-5 h-5"/>
        </button>
        <br>
        <div x-show="open" class="ml-2">
            <x-card>
                🤓 Cadastre suas vendas :)
            </x-card>
        </div>
    </div>

    <div class="mt-4">
        <livewire:vendas.create/>
    </div>

    <div class="mt-4">
        <livewire:vendas.show/>
    </div>

@endsection
