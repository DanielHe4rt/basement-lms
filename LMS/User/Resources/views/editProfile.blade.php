@extends('lms.templates.dashboard')
@section('css')
    <style>
        .fileinput {
            display: flex;
        }

        .photo-profile {
            border-radius: 50%;
            width: 80%;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-warning">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('users-me-update') }}" method="POST" enctype="multipart/form-data"  id="updateUserForm">
                        @csrf
                        @method('PUT')
                        <div class="text-right">
                            <p>Membro Desde: {{$user->created_at->format('d/m/Y')}}</p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center fileinput fileinput-new"
                                     data-provides="fileinput">
                                    <div class="col-12 text-center">
                                        <div class="fileinput-new thumbnail img-raised photo-profile">
                                            {{--                                        <img src="{{ $user->getFirstMedia()->getUrl() }}"--}}
                                            {{--                                             rel="nofollow" alt="...">--}}
                                            <img src="http://placehold.it/300x300"
                                                 rel="nofollow" alt="...">
                                        </div>
                                        <div
                                            class="fileinput-preview fileinput-exists thumbnail img-raised photo-profile"></div>
                                    </div>
                                    <div>
                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                        <span class="fileinput-new">Selecione uma imagem</span>
                                        <span class="fileinput-exists">Alterar</span>
                                        <input type="file" name="cover"/>
                                        </span>
                                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Remover</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $user->name }}"
                                           aria-describedby="name"
                                           placeholder="Nome Completo">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                           value="{{ $user->username }}"
                                           aria-describedby="username"
                                           placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">Documento</label>
                                    <input type="text" class="form-control" id="document_number" name="document_number"
                                           value="{{ $user->document_number }}"
                                           aria-describedby="name"
                                           placeholder="Documento">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">Telefone</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                           value="{{ $user->phone_number }}"
                                           aria-describedby="phone_number"
                                           placeholder="Númerod de telefone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                           value="{{ $user->email }}"
                                           aria-describedby="email"
                                           maxlength="120" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="subtitle">Data de Nascimento</label>
                                    <input type="text" class="form-control" id="birthdate" name="birthdate"
                                           value="{{ $user->birthdate }}"
                                           aria-describedby="birthdate"
                                           maxlength="120" placeholder="Data de Nascimento">
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4>Endereço</h4>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="subtitle">CEP</label>
                                        <input type="text" class="form-control" id="address.zip_code" name="address[zip_code]"
                                               value="{{ $user->address->zip_code }}"
                                               aria-describedby="zipcode"
                                               placeholder="CEP">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="subtitle">Cidade</label>
                                        <input type="text" class="form-control" id="address.city" name="address[city]"
                                               value="{{ $user->address->city }}"
                                               aria-describedby="cidade"
                                               placeholder="Cidade">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="subtitle">Estado</label>
                                        <input type="text" class="form-control" id="address.state" name="address[state]"
                                               value="{{ $user->address->state }}"
                                               aria-describedby="state"
                                               placeholder="UF">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="subtitle">Rua/Avenida</label>
                                        <input type="text" class="form-control" id="address.street" name="address[street]"
                                               value="{{ $user->address->street }}"
                                               aria-describedby="street"
                                               placeholder="Rua/Av">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="subtitle">Número</label>
                                        <input type="text" class="form-control" id="address.number" name="address[number]"
                                               value="{{ $user->address->number }}"
                                               aria-describedby="addressNumber"
                                               placeholder="Rua/Av">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="subtitle">Bairro</label>
                                        <input type="text" class="form-control" id="address.neighborhood" name="address[neighborhood]"
                                               value="{{ $user->address->neighborhood }}"
                                               aria-describedby="addressNeighborhood"
                                               placeholder="Bairro">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Atualizar Informações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(() => {
            $('#updateUserForm').submit(function(e) {
                e.preventDefault()
                let form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
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
                            for(let i in errors) {
                                toastr.error(errors[i]);
                            }
                            return false;
                        }

                        toastr.error('Ocorreu um erro ao atualizar o curso!.');
                        return false;
                    }
                })

                return false;
            });
        });
    </script>
@endsection

