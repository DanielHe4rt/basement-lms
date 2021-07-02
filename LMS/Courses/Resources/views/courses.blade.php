@extends('lms.templates.dashboard')
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
                            <h4 class="card-title">Cursos</h4>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('instructor-courses-new') }}" class="btn btn-primary mt-3 mr-3">Novo Curso</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="img-container">
                                        <img src="{{ asset('storage/doge.jpeg') }}" alt="...">
                                    </div>
                                </td>
                                <td class="td-name">
                                    <a>Laravel4Noobs</a>
                                    <br>
                                    <span class="badge badge-primary">Publicado</span>
                                    <small>Gratuito</small>
                                </td>
                                <td>
                                    <a>Número de inscritos: 100</a>
                                    <br>
                                    <a>Número de inscritos do mês: 50</a>
                                </td>
                                <td class="td-number text-center">
                                    <a>Classificação do curso</a>
                                    <div>
                                        <span class="material-icons-outlined">
                                            star_rate
                                        </span>
                                        <span class="material-icons-outlined">
                                            star_rate
                                        </span>
                                        <span class="material-icons-outlined">
                                            star_rate
                                        </span>
                                        <span class="material-icons-outlined">
                                            star_rate
                                        </span>
                                        <span class="material-icons-outlined">
                                            star_rate
                                        </span>

                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button">Gerenciar</button>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
