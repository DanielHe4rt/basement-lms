@extends('auth::template.app')
@section('page', 'login')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form id="loginForm" class="form" method="POST" action="{{ route('auth-login') }}">
            @csrf
            <div class="card card-login">
            <div class="card-header card-header-rose text-center">
                <h4 class="card-title">{{ trans('auth::view.login.title') }}</h4>
                <div class="social-line">
                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                        <i class="fab fa-google-plus"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <span class="bmd-form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">email</i>
                    </span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="{{ trans('auth::view.login.form.email') }}">
                </div>
                </span>
                <span class="bmd-form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="material-icons">lock_outline</i>
                    </span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="{{ trans('auth::view.login.form.password')}}">
                </div>
                </span>
            </div>
            <div class="card-footer justify-content-center">
                <button type="submit" class="btn btn-rose btn-link btn-lg">{{ trans('auth::view.login.form.submit')}}</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function (e) {
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    data: $(this).serialize(),
                    success: function (data) {
                        toastr.success("Logado com sucesso!")
                        setTimeout(function () {
                            window.location.href = "{{ route('dashboard') }}"
                        }, 2000);
                    },
                    error: function (data) {
                        let errors = data.responseJSON.errors;
                        for(let i in errors) {
                            toastr.error(errors[i]);
                        }
                    }
                });
                return false;
            });
        });
    </script>
@endsection
