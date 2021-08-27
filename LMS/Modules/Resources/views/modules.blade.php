@extends('lms.templates.dashboard')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <x-courses::course-navbar :course="$course" />

                <div class="card-body">
                    <button id="newModuleBtn" class="btn btn-info mt-3 mr-3">Criar Módulo</button>
                    @forelse($course->modules()->orderBy('order')->get() as $module)
                        <div class="card">
                            <div class="card-header card-header-text card-header-primary">
                                <div class="card-text">
                                    <h4 class="card-title">
                                        <div class="row">
                                            <div class="col-8">
                                                #{{ $module->order }} - {{ $module->name }}
                                            </div>
                                            <div class="col-4">
                                                <div class="text-right">
                                                    <button class="btn btn-danger btn-sm btnDeleteModule" data-id="{{ $module->id }}">
                                                        X
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </h4>
                                    <p class="card-category">{{ $module->description }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <x-lessons::lesson :module="$module"/>
                            </div>
                        </div>
                    @empty
                        <marquee>Sem módulos ainda =/</marquee>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extras')
    <div class="modal fade" id="newModuleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Criar novo Módulo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <form method="POST" action="{{ route('instructor-course-module-new', ['course' => $course]) }}">
                    @csrf

                    <div class="modal-body">
                        <p>
                            não sei
                        </p>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="subtitle"></label>
                                    <input type="text" class="form-control" id="subtitle" name="name"
                                           placeholder="Titulo do Módulo" maxlength="120">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle"></label>
                                    <input type="text" class="form-control" id="subtitle" name="description"
                                           placeholder="Descrição do Módulo" maxlength="120">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-link">Criar Módulo</button>
                        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newLessonModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Criar nova lição</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <form id="newLessonForm" method="POST">
                    <input type="hidden" name="module_id" id="moduleId">
                    @csrf
                    <div class="modal-body">
                        <p>
                            não sei
                        </p>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""></label>
                                    <select class="form-control" id="type_id" name="type_id">
                                        <option>Selecione um tipo de aula</option>
                                        @foreach(\LMS\Lessons\Models\Type::all() as $type)
                                            <option value="{{ $type->id }}"> {{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Titulo da Aula" maxlength="120">
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" class="form-control" id="description" name="description"
                                           placeholder="Descrição da aula" maxlength="120">
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300
        });
        $(".articleForm").submit(function(e) {
            e.preventDefault()
            let content = $('#summernote').summernote('code');

            $.ajax({
                type: "PUT",
                url: $(this).attr('action'),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                data: {
                    content: content
                },
                success: function (data) {
                    toastr.success("aaaaaaaaa fodase!")
                },
                error: function (data) {
                    let errors = data.responseJSON.errors;
                    for(let i in errors) {
                        toastr.error(errors[i]);
                    }
                }
            });
        });

        $("#newModuleBtn").click(function () {
            $("#newModuleModal").modal('toggle')
        });

        $(".btnDeleteModule").click(function () {

            let id = $(this).data('id');
            let url = "{{ route('instructor-course-module-delete', ['course' => $course->id, 'module' => ':id']) }}".replace(':id', id)

            $.ajax({
                type: "DELETE",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                success: function (data) {
                    toastr.success("Módulo removido com sucesso!")
                    setTimeout(function () {
                        window.location.reload()
                    }, 2000);
                },
                error: function (data) {
                    let errors = data.responseJSON.errors;
                    for(let i in errors) {
                        toastr.error(errors[i]);
                    }
                }
            });
        });

        $(".btnNewLesson").click(function () {
            let moduleId = $(this).data('id');
            $("#moduleId").val(moduleId)
            $("#newLessonModal").modal('toggle')
            let url = "{{ route('instructor-course-lesson-new', ['course' => $course, 'module' => ':module']) }}".replace(':module', moduleId)
            $("#newLessonForm").attr('action', url)
        })

        $(".inputUpload").on('change', function(e){
            let lessonId = $(this).data('lessonid');
            let moduleId = $(this).data('moduleid');
            let table = $("#lesson-upload-" + lessonId);
            let file = $(this).prop('files')[0];

            table.html(generateRows(file))

            let formData = new FormData();
            formData.append('video', file)
            let url = "{{ route('instructor-course-lesson-video-upload', ['course' => $course->id, 'module' => ':moduleId', 'lesson' => ':lessonId']) }}"
                .replace(':moduleId', moduleId)
                .replace(':lessonId', lessonId)

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    toastr.success("eaeaeaeaeeaeaeaeaeae")
                },
                error: function (data) {
                    let errors = data.responseJSON.errors;
                    for(let i in errors) {
                        toastr.error(errors[i]);
                    }
                }
            });
        });

    })

    function generateRows(data) {
        return `
        <tr>
            <td>${data.name}</td>
            <td>${data.type}</td>
            <td>merda</td>
            <td>tomanocu</td>
        </tr>
        `
    }
</script>
@endsection
