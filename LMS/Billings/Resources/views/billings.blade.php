@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Invoices</li>
    </ol>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Last Invoices</h4>
                </div>
                <div class="card-body">
                    @if($billings)
                    <h3>Próxima Transação</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Data</td>
                                <td>Valor</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{ $billings[0]['next_execution']->format('d/m/Y') }} </td>
                                <td> R$ {{ $billings[0]['price'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <hr>
                    <h3>Últimas transações</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td>Data</td>
                            <td>Valor</td>
                            <td>Status</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($billings as $billing)
                                @foreach($billing['history'] as $history)
                                    <tr>
                                        <td>{{ $history['created_at']->format('d/m/Y') }}</td>
                                        <td>R$ {{ $billing['price'] }}</td>
                                        <td>{{ $history['status'] }}</td>

                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
