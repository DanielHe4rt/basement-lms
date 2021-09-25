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
                <div class="row justify-content-around mt-2">
                    <div class="col-5 d-flex justify-content-center align-items-center">
                        <img src="https://placehold.it/300x300" class="photo-profile">
                    </div>
                    <div class="col-7">
                        <h3>{{ $user->username }}</h3>
                        <p>{{ $user->email }}</p>
                        <p>Membro desde: {{  $user['created_at']->format('d/m/Y H:i') }}</p>
                        <p>Último acesso: {{ $user->last_seen }}</p>
                        <p>Plano Atual: {{ $user->plan?->name ?? "Sem Plano"}}</p>
                        <hr>
                        <p>Cidade: {{$user->address->getCityAndState()}}</p>
                        <p>Endereço: {{$user->address->getFullAddress()}}</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="{{ route('edit-profile') }}">
                        <button class="btn btn-primary"> Editar Perfil</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
