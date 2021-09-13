<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="landing-page">
<nav class="navbar navbar-transparent navbar-danger navbar-expand-lg navbar-absolute text-white">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="page-header header-filter text-white" data-parallax="true"
     style="background-image: url('{{ asset('images/landing/bg-intro.png') }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <h1 class="title text-white">Quer aprender programação pagando o minimo do mercado?</h1>
                <h4>Aqui na nossa plataforma é precinho garantido Lorem ipsum dolor sit amet, consectetur adipisicing
                    elit. Adipisci alias aut beatae commodi culpa eos est, facere itaque minus molestias neque non
                    officia perferendis quia quisquam recusandae repellat ullam voluptatibus!</h4>
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
                <h2 class="title">O que conquistamos até agora</h2>
                <h5 class="description">Nossa plataforma está crescendo Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda culpa deleniti eaque eveniet ipsam, mollitia non tempora ullam unde
                    veritatis. Aliquid cum deserunt iure magni quos sit unde vero. Blanditiis!</h5>
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
                            <span style="font-weight: bold">1k+</span>
                            estudantes
                        </h4>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-success">
                            <i class="material-icons">videocam</i>
                        </div>
                        <h4 class="info-title">
                            <span style="font-weight: bold">40h</span>
                            de conteúdo
                        </h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="material-icons">cast_for_education</i>
                        </div>
                        <h4 class="info-title">
                            <span style="font-weight: bold">1000k</span>
                            de aulas assistidas
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="currentCourses" class="section text-center">
        <h2 class="title">Cursos disponíveis</h2>
        <div class="row justify-content-center">
            @foreach($courses = \LMS\Courses\Models\Course::paginate() as $course)
                <div class="col-12 col-sm-6 col-md-4">

                    <div class="card card-product">
                        <div class="card-header card-header-image">
                            <img class="img" src="{{ $course->getFirstMediaUrl() }}">
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
                            <div class="price">
                                <h4>{{ $course->paid ? trans('courses::view.manage.form.paid.true') : trans('courses::view.manage.form.paid.false') }}</h4>
                            </div>
                            <div class="stats">
                                <p class="card-category"><i
                                        class="material-icons">place</i> {{ $course->level->name }}</p>
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
                <h2 class="title">Nossos planos</h2>
                <h5 class="description">Nossa plataforma está crescendo Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda culpa deleniti eaque eveniet ipsam, mollitia non tempora ullam unde
                    veritatis. Aliquid cum deserunt iure magni quos sit unde vero. Blanditiis!</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category">Para Curiosos</h6>
                    <div class="card-body">
                        <h3 class="card-title">Grátis</h3>
                        <ul class="card-description">
                            <li><b>{{ \LMS\Courses\Models\Course::where('paid', false)->count() }}</b> Cursos</li>
                            <li><b>50</b> Horas de conteúdo</li>
                        </ul>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#pablo" class="btn btn-round btn-white">Registrar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing ">
                    <h6 class="card-category">Mensal</h6>
                    <div class="card-body">

                        <h3 class="card-title">R$ 35,00</h3>
                        <p class="card-description">
                        <ul>
                            <li><b>{{ \LMS\Courses\Models\Course::where('paid', true)->count() }}</b> Cursos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#pablo" class="btn btn-round btn-rose">Assinar Plano</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category">Semestral</h6>
                    <div class="card-body">
                        <h3 class="card-title">R$ 189,00</h3>
                        <p class="card-description">
                        <ul>
                            <li><b>{{ \LMS\Courses\Models\Course::where('paid', true)->count() }}</b> Cursos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#pablo" class="btn btn-round btn-white">Assinar Plano</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-pricing">
                    <h6 class="card-category"> Plano Anual</h6>
                    <div class="card-body">
                        <h3 class="card-title">R$ 350,00</h3>
                        <p class="card-description">
                        <ul>
                            <li><b>{{ \LMS\Courses\Models\Course::where('paid', true)->count() }}</b> Cursos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="card-footer justify-content-center ">
                        <a href="#pablo" class="btn btn-round btn-white">Choose Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>
</div>


<footer class="footer">
    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="http://www.creative-tim.com">
                        Creative Tim
                    </a>
                </li>
                <li>
                    <a href="http://presentation.creative-tim.com">
                        About Us
                    </a>
                </li>
                <li>
                    <a href="http://blog.creative-tim.com">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="http://www.creative-tim.com/license">
                        Licenses
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">
            ©
            <script>document.write(new Date().getFullYear())</script>
            2021, made with <i class="fa fa-heart heart"></i> by Creative Tim
        </div>
    </div>
</footer>

<script src="{{ mix('js/admin.js') }}"></script>
</body>
</html>
