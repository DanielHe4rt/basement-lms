@php
    $counter = 1;
@endphp

@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item"><a
                href="{{ route('course-preview', ['slug' => $course->slug]) }}">{{ explode(' ', $course->title)[0] }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Aula 1</li>
    </ol>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="card">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">{{ $lesson->title }} | {{ $course->title  }} </h4>
                </div>
                <div class="card-body">
                    <video controls crossorigin playsinline poster="{{ $lesson->getFirstMedia()->getUrl('thumb') }}"
                           id="player"></video>
                    <hr>
                    <div class="row">
                        <div class="col-9">
                            <h4>Descrição: </h4>
                            {!! $lesson->description !!}
                        </div>
                        <div class="col-3">
                            @if(Auth::user()->watched()->find($lesson))
                                <button class="btn btn-primary btn-block watchedBtn" data-id="{{ $lesson->id }}"
                                        data-status="1">Desmarcar como assistida
                                </button>
                            @else
                                <button class="btn btn-info btn-block watchedBtn" data-id="{{ $lesson->id }}"
                                        data-status="0">Marcar como assistida
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Conteúdo do Curso</h4>
                </div>
                <div class="card-body">
                    <x-modules::lecture-modules :course="$course" :lesson="$lesson"/>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.dashjs.org/latest/dash.all.min.js"></script>
    <script>
        const source = "{{ $lesson->getStreamingUrl('Dash')['url'] }}";
        const dash = dashjs.MediaPlayer().create();
        const video = document.querySelector('video');
        const qualities = [1080, 720, 576, 480, 360];
        dash.initialize(video, source, true);
        const player = new Plyr(video, {
            settings: ['speed', 'quality'],
            quality: {
                default: 720,
                options: qualities,
                forced: true,
                onChange: (e) => changePlayerQuality(e)
            }
        })
        window.player = player;
        window.dash = dash;

        function changePlayerQuality(newQuality) {
            console.log(dash.getSettings())
            qualities.forEach((level, levelIndex) => {
                if (level === newQuality) {
                    console.log("Found quality match with " + newQuality);
                    dash.setQualityFor('video', levelIndex, true)
                    return true;
                }
            });
        }

        $(document).ready(function () {
            $('body').addClass('sidebar-mini');
            md.misc.sidebar_mini_active = true;
        });

        $(document).on('click', '.watchedBtn', function (e) {
            let lessonId = $(this).data('id')
            let status = $(this).data('status')

            let lectureDiv = $("#lecture-" + lessonId)
            if (status) {
                $(this).html("Marcar como assistida")
                lectureDiv.html("❌")
                $(this).removeClass('btn-primary').addClass('btn-info')
            } else {
                lectureDiv.html("✅")
                $(this).html("Desmarcar como assistida")
                $(this).removeClass('btn-info').addClass('btn-primary')
            }
            $(this).data('status', !status)
            watchedStatus()

        });

        $(document).on('click', '.funcionacaralho', function (e) {
            e.preventDefault()

            let url = $(this).data('url')
            window.location.href = url;
        })

        player.on('ended', event => {
            @unless(Auth::user()->watched()->find($lesson))
                watchedStatus()
            @endunless
        })

        const watchedStatus = () => {
            $.ajax({
                url: '{{ route('course-lesson-watched', ['slug' => $course->slug, 'lesson' => $lesson]) }}',
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"}
            });
        }
    </script>
@endsection
