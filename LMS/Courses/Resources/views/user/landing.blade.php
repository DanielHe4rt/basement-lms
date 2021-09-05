@php
    $counter = 1;
@endphp

@extends('lms.templates.dashboard')
@section('css')
    <style>
        #stars > .material-icons-outlined {
            color: gold;
            font-size: 14px;
        }

        #stars > .material-icons {
            color: gold;
            font-size: 14px;
        }

    </style>
@endsection
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">{{ explode(' ', $course->title)[0] }}</li>
    </ol>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <img src="{{ $course->getFirstMediaUrl() }}" class="img-thumbnail m-5">
                    </div>
                    <div class="col-8">
                        <h3>{{ $course->title }}</h3>
                        <p>{{ $course->subtitle }}</p>
                        <hr>
                        <div>
                            <div class="row">
                                <div class="col">
                                    <strong style="font-weight: 600">Nível:</strong> {{ $course->level->name }}
                                    <strong
                                        style="font-weight: 600">Tipo:</strong> {{ $course->paid ? trans('courses::view.manage.form.paid.true') : trans('courses::view.manage.form.paid.false') }}
                                    <strong style="font-weight: 600">Alunos:</strong> {{ $course->students()->count() }}
                                    <div id="stars">
                                        <strong style="font-weight: 600">Classificação: 4.9</strong>
                                        <span class="material-icons">
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
                                    <div class="row">
                                        <div class="col-3">
                                            @if(Auth::user()->enrollments()->find($course->id))
                                                <a href="{{ route('course-lesson-redirect', ['slug' => $course->slug]) }}"
                                                   class="btn btn-primary btn-block">Acessar curso</a>
                                            @else
                                                <form method="POST"
                                                      action="{{ route('course-join', ['course' => $course]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-block">Inscrever no curso
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <div class="progress-container pt-1">
                                                <span class="progress-badge">Progresso do curso</span>
                                                <div class="progress" style="height: 9px">
                                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="25"
                                                          style="width: {{ $course->progress }}%;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>{!! $course->description !!}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-nav-tabs ">
                <div class="card-header card-header-primary text-center">
                    Grade Curricular
                </div>
                <div class="card-body">
                    <h4 class="card-title">Special title treatment</h4>
                    <div id="accordion" role="tablist">
                        @foreach($course->modules()->orderBy('order')->get() as $key => $module)
                            <div class="card card-collapse">
                                <div class="card-header" role="tab" id="moduleH-{{ $key }}">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#module-{{ $key }}" aria-expanded="true">
                                            {{ $key + 1 }} {{ $module->name }} {{ $module->duration }}
                                            <i class="material-icons">keyboard_arrow_down</i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="module-{{ $key }}" class="collapse {{ $key == 0 ? 'show' : '' }}"
                                     role="tabpanel">
                                    <div class="card-body">
                                        <table class="table">
                                            @foreach($module->lessons as $key => $lesson)
                                                <tr>
                                                    <td>
                                                        @switch($lesson->type_id)
                                                            @case($video = 1)
                                                            🎥
                                                            @break;
                                                            @case($article = 2)
                                                            📃
                                                            @break;
                                                            @case($quiz = 3)
                                                            🤔
                                                            @break;
                                                        @endswitch
                                                        Aula {{ $counter++ }} -{{ $lesson->title }}
                                                    </td>
                                                    <td>  {{ $lesson->duration }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
