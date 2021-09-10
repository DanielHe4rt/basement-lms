@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Providers</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">My Providers</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <hr>
                        <table class="table text-left">
                            <tbody>
                            @foreach(\LMS\Billings\Models\Provider::all() as $provider)
                                <tr>
                                    <td><img class="img-thumbnail" src="{{ $provider->image }}" alt="" width="70"></td>
                                    <td>{{ $provider->name }}</td>
                                    <td>
                                        @if($provider->active)
                                            <button class="btn btn-success">Ativo</button>
                                        @else
                                            <form method="POST"
                                                  action="{{ route('billings-providers-update', ['provider' => $provider]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning btnActivate"
                                                        data-id="{{ $provider->id }}">Ativar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection
