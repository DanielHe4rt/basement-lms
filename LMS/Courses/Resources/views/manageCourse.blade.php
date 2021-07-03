@extends('lms.templates.dashboard')
@section('css')
    <style>
        .fileinput {
            display: flex;
        }

        .fileinput .thumbnail {
            max-width: 100%;
        }
    </style>
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
                            <h4 class="card-title">Cursos</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-warning">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <form action="{{ route('instructor-courses-create') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $course->title }}"
                                       aria-describedby="courseTitle" placeholder="Enter course title." maxlength="60">
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $course->subtitle }}"
                                       aria-describedby="courseSubtitle" placeholder="Enter course subtitle."
                                       maxlength="120">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                          aria-describedby="courseDescription"
                                          placeholder="Write a short resume of your course.">{{ $course->description }}</textarea>
                            </div>
                            <div class="form-row mb-5">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="paid" name="paid">
                                            <option value="0" {{ !$course->paid ? 'selected' : '' }}>Gratuito</option>
                                            <option value="1" {{ $course->paid ? 'selected' : '' }}>Pago</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-control" id="course_level_id" name="course_level_id">
                                            <option value="" selected disabled>Select the course level.</option>
                                            <option value="1">Beginner</option>
                                            <option value="2">Intermediate</option>
                                            <option value="3">Advanced</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row fileinput fileinput-new" data-provides="fileinput">
                                <div class="col-6">
                                    <div class="fileinput-new thumbnail img-raised">
                                        <img src="{{ asset('storage/' . $course->cover_path) }}"
                                             rel="nofollow" alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <p>
                                            Faça o upload da imagem do seu curso aqui. Ela deve atender aos nossos padrões
                                            de qualidade da imagem do curso para ser aceita. Diretrizes importantes: ter 750
                                            x 422 pixels, estar no formato .jpg, .jpeg,. gif ou .png. e não ter nenhum texto
                                            na imagem.
                                        </p>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="cover"/>
                                    </span>
                                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
