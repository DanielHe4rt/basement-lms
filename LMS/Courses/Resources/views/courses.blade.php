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
                            <h4 class="card-title">{{ trans('courses::view.general.title') }}</h4>
                        </div>
                        <div class="col text-right">

                            <a href="{{ route('instructor-courses-new') }}" class="btn btn-primary mt-3 mr-3">{{ trans('courses::view.general.newCourse') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <hr>
                        <table class="table table-shopping">
                            <tbody>
                            @forelse($courses as $course)
                                <tr>
                                <td>
                                    <div class="img-container">
                                        <img src="{{ $course->getFirstMedia()->getUrl() }}" alt="...">
                                    </div>
                                </td>
                                <td class="td-name">
                                    <a>{{ $course->title }}</a>
                                    <br>
                                    @if($course->published_at)
                                        <span class="badge badge-primary">{{ trans('courses::view.general.card.status.published') }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ trans('courses::view.general.card.status.sketch') }}</span>
                                    @endif
                                    <small>{{ $course->paid ? trans('courses::view.general.card.monetize.paid') : trans('courses::view.general.card.monetize.free') }}</small>
                                </td>
                                <td>
                                    <a>{{ trans('courses::view.general.card.students', ['number' => 123]) }}</a>
                                    <br>
                                    <a>{{ trans('courses::view.general.card.monthlyStudents', ['number' => 123]) }}</a>
                                </td>
                                <td class="td-number text-center">
                                    <a>{{ trans('courses::view.general.card.stars') }}</a>
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
                                    <a class="btn btn-primary" href="{{ route('instructor-course-manage', ['course' => $course]) }}">
                                        {{ trans('courses::view.general.card.actions.manage') }}
                                    </a>
                                    <button class="btn btn-danger delete-course" data-course="{{ $course->id}}">
                                        {{ trans('courses::view.general.card.actions.delete') }}
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <p>
                                    Parece que você não tem nenhum curso cadastrado.
                                </p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            $('button.delete-course').click(function () {
                let id = $(this).data('course');
                console.log($(this).data('course'));
                let url = "{{ route('instructor-courses-delete', ['course' => ':id']) }}".replace(':id', id);

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    success: function () {
                        toastr.success('Curso deletado com sucesso!');
                        setTimeout(() => {
                            window.location.href = "{{ route('instructor-courses') }}";
                        }, 750)
                    },
                    error: function () {
                        toastr.error('Ocorreu um erro ao criar o curso.');
                        return false;
                    }
                });
                return false;
            });
        })
    </script>
@endsection
