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
        <div class="col">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Novo Curso</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('instructor-courses-create') }}" method="POST" enctype="multipart/form-data" id="createCourseForm">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                   aria-describedby="courseTitle" placeholder="Enter course title." maxlength="60">
                        </div>

                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" required
                                   aria-describedby="courseSubtitle" placeholder="Enter course subtitle."
                                   maxlength="120">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required
                                      rows="5" aria-describedby="courseDescription"
                                      placeholder="Write a short resume of your course."></textarea>
                        </div>
                        <div class="form-row mb-5">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" id="paid" name="paid" required>
                                        <option value="0" selected>Gratuito</option>
                                        <option value="1">Pago</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" id="course_level_id" name="course_level_id" required>
                                        <option value="" selected disabled>Select the course level.</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row fileinput fileinput-new" data-provides="fileinput">
                            <div class="col-6">
                                <div class="fileinput-new thumbnail img-raised">
                                    <img src="http://placehold.it/750x422"
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
                                        <input type="file" name="cover" required/>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            let levels_endpoint = '{{ route('get-course-levels')}}'

            $.ajax({
                url: levels_endpoint,
                success: (response) => {
                    let select = $('#course_level_id');

                    for (const level of response) {
                        let option = new Option(level.name, level.id, false, false);
                        select.append(option);
                    }
                },
                error: () => toastr.error('Falha ao buscar níveis.')
            })

            $('#createCourseForm').submit(function(e) {
                e.preventDefault()
                let form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        toastr.success('Curso criado com sucesso!');
                        setTimeout(() => {
                           window.location.href = "{{ route('instructor-course-manage', ':id') }}".replace(':id', response.id);
                        }, 1000)
                    },
                    error: function (response) {
                        console.log(response);
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            for(let i in errors) {
                                toastr.error(errors[i]);
                            }
                            return false;
                        }

                        toastr.error('Ocorreu um erro ao criar o curso.');
                        return false;
                    }
                })

                return false;
            });
        });
    </script>
@endsection
