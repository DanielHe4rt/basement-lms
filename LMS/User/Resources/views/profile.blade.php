@extends('lms.templates.dashboard')
@section('css')
    <style>
        .photo-profile {
            border-radius: 50%;
            width: 80%;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="row justify-content-between mt-2">
                    <div class="col-4 m-2">
                        <img src="https://placehold.it/300x300" class="photo-profile">
                    </div>
                    <div class="col-7">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <p>Membro desde: {{  $user['created_at']->format('d/m/Y H:i') }}</p>
                        <p>Último acesso: {{ $user->last_seen }}</p>
                        <p>Plano Atual: {{ $user->plan?->name ?? "Sem Plano"}}</p>
                        <hr>
                        <p>Cidade: {{$user->address->city}} / {{$user->address->state}}</p>
                        <p>Endereço: {{$user->address->street}} - {{$user->address->number}} - {{$user->address->neighborhood}} {{$user->address->complement}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
