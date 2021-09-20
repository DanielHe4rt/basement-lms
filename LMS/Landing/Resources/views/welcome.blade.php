<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="landing-page">

@yield('navbar', View::make('auth::components.navbar'))


<div class="page-header header-filter text-white" data-parallax="true"
     style="background-image: url('{{ asset('images/landing/bg-intro.png') }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="title text-white">{{ trans('landing::view.welcome.title') }}</h1>
                <h4>{{ trans('landing::view.welcome.lead') }}</h4>
                <br>
            </div>
            <div class="col-12 col-md-6">
                <iframe width="560" height="400" src="https://www.youtube.com/embed/boGrhCATg3s"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <section id="trophys" class="text-center">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="title">{{ trans('landing::view.achievements.title') }}</h2>
                <h5 class="description">{{ trans('landing::view.achievements.lead') }}</h5>
            </div>
        </div>

        <div class="features">
            <div class="row">
                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-info">
                            <i class="material-icons">school</i>
                        </div>
                        <h4 class="info-title">
                            <span style="font-weight: bold">{{ $landingData['achievements']['students'] }}</span>
                            {{ trans('landing::view.achievements.items.students') }}
                        </h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-success">
                            <i class="material-icons">videocam</i>
                        </div>
                        <h4 class="info-title">
                            <span style="font-weight: bold">{{ $landingData['achievements']['contentHours'] }}h</span>
                            {{ trans('landing::view.achievements.items.contentTime') }}
                        </h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="material-icons">cast_for_education</i>
                        </div>
                        <h4 class="info-title">
                            <span style="font-weight: bold">{{ $landingData['achievements']['watchedLessons'] }}</span>
                            {{ trans('landing::view.achievements.items.watchedLessons') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="currentCourses" class="section text-center">
        <h2 class="title">{{ trans('landing::view.availableCourses.title') }}</h2>
        <div class="row justify-content-center">
            @foreach($courses = \LMS\Courses\Models\Course::paginate() as $course)
                <div class="col-12 col-sm-6 col-md-4">

                    <div class="card card-product">
                        <div class="card-header card-header-image">
                            <img class="img" src="{{ $course->getFirstMediaUrl() }}" alt="Capa do curso {{ $course->title }}">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $course->title }}
                            </h4>
                            <div class="card-description" style="min-height: 92px">
                                {{ $course->subtitle }}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <p class="card-category">
                                    <i class="material-icons">shopping_cart</i>{{ $course->paid ? trans('courses::view.manage.form.paid.true') : trans('courses::view.manage.form.paid.false') }}
                                    <i class="material-icons ml-2">extension</i>{{ $course->level->name }}
                                </p>
                            </div>
                            <div class="stats">
                                <p class="card-category"><i
                                        class="material-icons">schedule</i> {{ gmdate('H:i', $course->duration) }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </section>
    <hr>
    <section id="plans" class="text-center">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <h2 class="title">{{ trans('landing::view.pricing.title') }}</h2>
                <h5 class="description">{{ trans('landing::view.pricing.lead') }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category">{{ trans('landing::view.pricing.card.headers.free') }}</h6>
                    <div class="card-body">
                        <h3 class="card-title">{{ trans('landing::view.pricing.card.descriptions.free') }}</h3>
                        <ul class="card-description">
                            <li><b>{{ $landingData['courses']['free']['count'] }}</b> {{ trans('landing::view.pricing.card.descriptions.courseCount') }}</li>
                            <li><b>{{ $landingData['courses']['free']['time'] }}</b> {{ trans('landing::view.pricing.card.descriptions.hoursCount') }}</li>
                            <li><b>{{ $landingData['courses']['free']['support'] ? '✅' : '❌' }}</b> {{ trans('landing::view.pricing.card.descriptions.support') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#" class="btn btn-round btn-rose">{{ trans('landing::view.pricing.card.buttons.register') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing ">
                    <h6 class="card-category">{{ trans('landing::view.pricing.card.headers.monthly') }}</h6>
                    <div class="card-body">
                        <h3 class="card-title">R$ 35,00</h3>
                        <ul class="card-description">
                            <li><b>{{ $landingData['courses']['paid']['count'] }}</b> {{ trans('landing::view.pricing.card.descriptions.courseCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['time'] }}</b> {{ trans('landing::view.pricing.card.descriptions.hoursCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['support'] ? '✅' : '❌' }}</b> {{ trans('landing::view.pricing.card.descriptions.support') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#" class="btn btn-round btn-rose">{{ trans('landing::view.pricing.card.buttons.subscribe') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category">{{ trans('landing::view.pricing.card.headers.semester') }}</h6>
                    <div class="card-body">
                        <h3 class="card-title">R$ 189,00</h3>
                        <ul class="card-description">
                            <li><b>{{ $landingData['courses']['paid']['count'] }}</b> {{ trans('landing::view.pricing.card.descriptions.courseCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['time'] }}</b> {{ trans('landing::view.pricing.card.descriptions.hoursCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['support'] ? '✅' : '❌' }}</b> {{ trans('landing::view.pricing.card.descriptions.support') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#" class="btn btn-round btn-rose">{{ trans('landing::view.pricing.card.buttons.subscribe') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category">{{ trans('landing::view.pricing.card.headers.yearly') }}</h6>
                    <div class="card-body">
                        <h3 class="card-title">R$ 350,00</h3>
                        <ul class="card-description">
                            <li><b>{{ $landingData['courses']['paid']['count'] }}</b> {{ trans('landing::view.pricing.card.descriptions.courseCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['time'] }}</b> {{ trans('landing::view.pricing.card.descriptions.hoursCount') }}</li>
                            <li><b>{{ $landingData['courses']['paid']['support'] ? '✅' : '❌' }}</b> {{ trans('landing::view.pricing.card.descriptions.support') }}</li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#" class="btn btn-round btn-rose">{{ trans('landing::view.pricing.card.buttons.subscribe') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
</div>
@yield('footer', View::make('auth::components.footer'))

<script src="{{ mix('js/admin.js') }}"></script>
</body>
</html>
