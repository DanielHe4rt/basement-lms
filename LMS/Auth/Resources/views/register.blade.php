@extends('auth::template.app')
@section('content')
    <div class="row">
        <div class="col-md-10 ml-auto mr-auto">
            <div class="card card-signup">
                <h2 class="card-title text-center">{{ trans('auth::view.register.title') }}</h2>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="info info-horizontal">
                                <div class="icon icon-rose">
                                    <i class="material-icons">{{ trans('auth::view.register.cards.1st.material-icon') }}</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title"> {{ trans('auth::view.register.cards.1st.title') }} </h4>
                                    <p class="description">
                                        {{ trans('auth::view.register.cards.1st.description') }}
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-primary">
                                    <i class="material-icons">{{ trans('auth::view.register.cards.2nd.material-icon') }}</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{ trans('auth::view.register.cards.2nd.title') }}</h4>
                                    <p class="description">
                                        {{ trans('auth::view.register.cards.2nd.description') }}
                                    </p>
                                </div>
                            </div>
                            <div class="info info-horizontal">
                                <div class="icon icon-info">
                                    <i class="material-icons">{{ trans('auth::view.register.cards.3rd.material-icon') }}</i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title">{{ trans('auth::view.register.cards.3rd.title') }}</h4>
                                    <p class="description">
                                        {{ trans('auth::view.register.cards.3rd.description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mr-auto">
                            <div class="social text-center">
                                <button class="btn btn-just-icon btn-round btn-twitter">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button class="btn btn-just-icon btn-round btn-google">
                                    <i class="fab fa-google"></i>
                                </button>
                                <h4 class="mt-3"> ou </h4>
                            </div>
                            <form id="registerForm" class="form" method="POST" action="{{ route('auth-register') }}">
                                @csrf
                                <div class="form-group has-default bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">face</i>
                                            </span>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="{{ trans('auth::view.register.form.name') }}">
                                    </div>
                                </div>
                                <div class="form-group has-default bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">mail</i>
                                            </span>
                                        </div>
                                        <input type="email" name="email" class="form-control" placeholder="{{ trans('auth::view.register.form.email') }}">
                                    </div>
                                </div>
                                <div class="form-group has-default bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">account_circle</i>
                                            </span>
                                        </div>
                                        <input type="text" name="username" class="form-control" placeholder="{{ trans('auth::view.register.form.username') }}">
                                    </div>
                                </div>
                                <div class="form-group has-default bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" placeholder="{{ trans('auth::view.register.form.password') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group has-default bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="material-icons">lock_outline</i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation" placeholder="{{ trans('auth::view.register.form.password_confirmation') }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="" checked="">
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        {!!  trans('auth::view.register.form.terms', ['link' => '#'])  !!}
                                    </label>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-round mt-4" value="{{ trans('auth::view.register.form.submit') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#registerForm").submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    data: $(this).serialize(),
                    success: function (data) {
                        toastr.success("registrado com sucesso!")
                        setTimeout(function () {
                            window.location.href = "{{ route('login') }}"
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
        });
    </script>
@endsection
