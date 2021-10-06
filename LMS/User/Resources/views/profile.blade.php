@extends('lms.templates.dashboard')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12 col-sm-12">
            <div class="card card-profile">

                <div class="card-header card-header-icon card-header-rose">
                    <div class="card-avatar">
                        <img class="img profile-img" style="min-height: 160px; min-width: 160px;" src="{{ $user->image_url }}">
                        <label for="inputProfilePic" class="btn btn-rose" style="top: -45px;">Trocar Avatar</label>
                    </div>
                    <input id="inputProfilePic" type="file" name="image" style="display: none;">
                </div>
                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('users-me-update') }}" method="POST" enctype="multipart/form-data"
                          id="updateUserForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{ __('Nome de Usuário') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{ __('Username') }}</label>
                                    <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{ __('Documento - CPF') }}</label>
                                    <input type="text" class="form-control" name="document_number" value="{{ $user->document_number }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">{{ __('Telefone') }}</label>
                                    <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="">{{ __('Data de Nascimento') }}</label>
                                    <input type="date" class="form-control" name="birthdate" value="{{ $user->birthdate }}">
                                </div>
                            </div>
                        </div>
                        <h5 class="mt-4 mb-2">{{ __('Dados de Cobrança') }}</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Endereço</label>
                                    <input type="text" class="form-control" name="address[street]" value="{{ $user->address->street }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Número</label>
                                    <input type="text" class="form-control" name="address[number]" value="{{ $user->address->number }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Bairro</label>
                                    <input type="text" class="form-control" name="address[neighborhood]" value="{{ $user->address->neighborhood }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Cidade</label>
                                    <input type="text" class="form-control" name="address[city]" value="{{ $user->address->city }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    <select class="form-control" name="address[state]">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito</option>
                                        <option value="ES">Espirito</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">CEP</label>
                                    <input type="text" class="form-control" name="address[zip_code]" value="{{ $user->address->zip_code }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-rose btn-block pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i> <span class="float-right">  {{__('Membro desde ') . $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            $('#updateUserForm').submit(function (e) {
                e.preventDefault()

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = "{{ route('users-me-profile') }}";
                        }, 1000)
                    },
                    error: function (response) {
                        console.log(response);
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            for (let i in errors) {
                                toastr.error(errors[i]);
                            }
                            return false;
                        }
                        return false;
                    }
                })

                return false;
            });

            $("#inputProfilePic").change(function(e) {
                let reader = new FileReader();
                let documentId = document.getElementById('inputProfilePic');

                let form = new FormData();
                form.append('image', documentId.files[0])

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('users-me-picture') }}',
                    method: 'POST',
                    data: form,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        reader.onload = function (evt) {
                            $('.profile-img').attr('src', evt.target.result);
                        };
                        reader.readAsDataURL(documentId.files[0]);
                        toastr.success(response.message);
                    },
                    error: function (response) {
                        console.log(response);
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            for (let i in errors) {
                                toastr.error(errors[i]);
                            }
                            return false;
                        }
                        return false;
                    }
                })
            })
        });
    </script>
@endsection

