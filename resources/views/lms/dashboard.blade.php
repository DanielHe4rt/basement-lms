@extends('lms.templates.dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons"></i>
                </div>
                <h4 class="card-title">Vai toma no cu front-end blalalalau</h4>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive table-sales">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            @foreach($courses = \LMS\Courses\Models\Course::paginate() as $course)
                <div class="col-12 col-sm-4 col-md-3">
                    <a href="{{ route('course-preview', ['slug' => $course->slug]) }}" style="cursor: pointer;">
                        <div class="card card-product">
                            <div class="card-header card-header-image">
                                <img class="img" src="{{ $course->getFirstMediaUrl() }}">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title" style="font-size: 1.1rem;">
                                    {{ $course->title }}
                                </h4>
                                <div class="card-description" style="min-height: 92px">
                                    {{ $course->subtitle }}
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="price">
                                    <h4>{{ $course->paid ? trans('courses::view.manage.form.paid.true') : trans('courses::view.manage.form.paid.false') }}</h4>
                                </div>
                                <div class="stats">
                                    <p class="card-category"><i
                                            class="material-icons">place</i> {{ $course->level->name }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
