
@if($type == 'mostRated')
<div class="card">
    <div class="hero-ribbon-wrapper">
        <div class="ribbon">Gratuito</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img class="hero-image img-fluid" src="{{ $course->getFirstMediaUrl() }}"
                     alt="{{ $course->name }} thumbnail">
            </div>
            <div class="col-md-8">
                <h2 class="hero-title"> {{ $course->title }}</h2>
                <p class="hero-description card-description"> {!! substr($course->description, 0, 450) !!}...</p>
                <div  class="text-right">
                    <form method="POST" action="{{ route('course-join', ['course' => $course]) }}">
                        @csrf
                        <span class="card-category mr-3"><i class="material-icons">people</i> {{ $course->students()->count() }}</span>
                        <span class="card-category mr-3"><i class="material-icons">schedule</i> {{ gmdate('H:i', $course->duration) }}</span>
                        <a href="{{ route('course-preview', ['slug' => $course->slug]) }}" class="btn btn-secondary" style="text-decoration: underline">Ver Grade Curricular</a>
                        <button type="submit" class="btn btn-primary">Começar Agora</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if($type == 'lastSeen')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="hero-image img-fluid" src="{{ $course->getFirstMediaUrl() }}"
                         alt="{{ $course->name }} thumbnail">
                </div>
                <div class="col-md-8">
                    <h2 class="hero-title"> {{ $course->title }}</h2>
                    <p class="hero-description card-description"> {!! substr($course->description, 0, 450) !!}...</p>
                    <div class="progress-container pt-1">
                        <span class="progress-badge">Progresso do curso</span>
                        <span class="progress-badge float-right">{{ $course->progress }}%</span>
                        <div class="progress" style="height: 9px">
                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="25"
                                 style="width: {{ $course->progress }}%;">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="card-category mr-3"><i class="material-icons">people</i> {{ $course->students()->count() }}</span>
                        <span class="card-category mr-3"><i class="material-icons">schedule</i> {{ gmdate('H:i', $course->duration) }}</span>
                        <a href="{{ route('course-preview', ['slug' => $course->slug]) }}" class="btn btn-secondary" style="text-decoration: underline">Ver Grade Curricular</a>
                        <a href="{{ route('course-lesson-redirect', ['slug' => $course->slug]) }}" class="btn btn-primary">
                            <i class="material-icons mr-3">play_arrow</i>
                            Continuar Assistindo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
