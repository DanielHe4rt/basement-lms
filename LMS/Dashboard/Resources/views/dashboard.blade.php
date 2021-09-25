@extends('lms.templates.dashboard')
@section('content')
    <div class="container-fluid dashboard">
        <x-dashboard-hero :hero="$hero" />
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
                                <div class="stats">
                                    <p class="card-category">
                                        <i class="material-icons"
                                           style="top: 0;">shopping_cart</i>{{ $course->paid ? trans('courses::view.manage.form.paid.true') : trans('courses::view.manage.form.paid.false') }}
                                        <i class="material-icons ml-2"
                                           style="top: 0;">extension</i>{{ $course->level->name }}
                                    </p>
                                </div>
                                <div class="stats">
                                    <p class="card-category"><i
                                            class="material-icons"
                                            style="top: 0;">schedule</i> {{ gmdate('H:i', $course->duration) }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
