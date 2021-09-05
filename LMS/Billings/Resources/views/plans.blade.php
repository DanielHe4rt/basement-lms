@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Plans</li>
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
                            <h4 class="card-title">My Plans and Subscriptions</h4>
                            <p style="color: #3C4858">
                                Provider: {{ \LMS\Billings\Models\Provider::where('active',true)->first()->name ?? 'Não selecionado' }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <hr>
                        <button class="btn btn-primary btnPlanModal">Criar Plano</button>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Plano</td>
                                    <td>Recorrência</td>
                                    <td>Valor</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>
                                        <td>{{ $plan->interval }}</td>
                                        <td>{{ $plan->subscription->price }}</td>
                                        <td>
                                            <button class="btn btn-warning">Editar</button>
                                            <button class="btn btn-danger">Deletar</button>
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

@section('extras')
    <div class="modal fade" id="newPlanModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Criar nova lição</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <form id="newPlanForm" method="POST" action="{{ route('billings-plans-create') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" class="form-control" id="title" name="name"
                                   placeholder="Nome do plano" maxlength="120">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" id="interval" name="interval">
                                <option>Selecione o intervalo de cobranças</option>
                                <option value="1">Mensal</option>
                                <option value="3">Trimestral</option>
                                <option value="6">Semestral</option>
                                <option value="12">Anual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="tel" class="form-control" id="title" name="price"
                                   placeholder="Valor do Plano: 35,00">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-link">Criar Lição</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(".btnPlanModal").click(function () {
                $("#newPlanModal").modal('toggle')
            })

            $("#newPlanForm").submit(function (e) {
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    data: $(this).serialize(),
                    success: function (data) {
                        toastr.success("Artigo salvo!")
                    },
                    error: function (data) {
                        let errors = data.responseJSON.errors;
                        for (let i in errors) {
                            toastr.error(errors[i]);
                        }
                    }
                });
            });
        });
    </script>
@endsection
