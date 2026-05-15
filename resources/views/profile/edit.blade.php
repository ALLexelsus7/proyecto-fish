@extends('layouts.app')

{{-- Seccion para editar perfil de usuario --}}
@section('content')
<div class="min-h-screen py-64">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <div class="flex gap-4 mb-8">
            <a href="{{ route('dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                    <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="text-3xl font-black text-white italic tracking-tighter">AJUSTES DE <span class="text-magma-diablillo">BITÁCORA</span></h2>
        </div>

        <div class="tarjeta-cristal p-8 border border-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="tarjeta-cristal p-8 border border-white/10">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="tarjeta-cristal p-8 border border-red-900/30">
            <div class="max-w-xl text-red-400">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection