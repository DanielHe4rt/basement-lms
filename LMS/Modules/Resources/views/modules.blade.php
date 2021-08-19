@extends('lms.templates.dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <x-courses::course-navbar :course="$course" />

                <div class="card-body">
                    <button id="newModuleBtn" class="btn btn-primary mt-3 mr-3">Criar Módulo</button>
                    @forelse($course->modules()->orderBy('order')->get() as $module)
                        <div class="card">
                            <div class="card-header card-header-text card-header-primary">
                                <div class="card-text">
                                    <h4 class="card-title">#{{ $module->order }} - {{ $module->name }}</h4>
                                    <p class="card-category">{{ $module->description }}</p>
                                </div>

                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tbody class="text-center">
                                    <tr>
                                        Você não lições ainda =/
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <button class="btn btn-danger btn-sm btnDeleteModule" data-id="{{ $module->id }}">
                                        X
                                    </button>
                                </div>
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
    <div class="modal fade" id="newModuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
@endsection

@section('scripts')
<script>
    $(document).ready(function () {

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
    })
</script>
@endsection
