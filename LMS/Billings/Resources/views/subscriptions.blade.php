@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Providers</li>
    </ol>
@endsection
@section('css')
    <style>
        .selected {
            -webkit-box-shadow: 0px 1px 10px 2px rgba(82, 29, 82, 1);
            -moz-box-shadow: 0px 1px 10px 2px rgba(82, 29, 82, 1);
            box-shadow: 0px 1px 10px 2px rgba(82, 29, 82, 1);
            transition: box-shadow ease-in-out 0.3s;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Available Subscriptions</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        @foreach($plans as $plan)
                            <div class="col-4">
                                <div class="card text-white bg-primary text-center subscriptionBtn"
                                     style="cursor: pointer;" data-id="{{ $plan->id }}">
                                    <h4 class="mt-3">{{ $plan->name }}</h4>
                                    <p>R$ {{ $plan->price }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="btnSelectPlan" class="btn btn-primary btn-block " disabled>Select Plan</button>
                </div>
            </div>
        </div>
        <div class="col-md-8" id="step2" style="display: none">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Billing Information</h4>
                </div>
                <div class="card-body">
                    <form id="formUserInfo" action="{{ route('users-me-update') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Email</label>
                                <input type="Email" class="form-control" id="inputEmail4"
                                       value="{{Auth::user()->email}}" placeholder="Email" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Telefone</label>
                                <input type="tel" class="form-control" name="phone_number" id="inputEmail4"
                                       value="{{Auth::user()->phone_number}}" placeholder="Telefone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">CPF</label>
                                <input type="CPF" class="form-control" name="document_number" id="inputCPF4"
                                       value="{{Auth::user()->document_number}}" placeholder="CPF">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBirthday">Data de nascimento</label>
                                <input type="date" class="form-control" name="birthdate" id="inputCPF4"
                                       value="{{Auth::user()->birthdate}}" placeholder="Data de Nascimento">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="inputEndereço">Endereço</label>
                                <input type="text" class="form-control" id="inputEndereço" name="address[street]"
                                       value="{{Auth::user()->address->street}}" placeholder="Rua das Flores">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEndereço">Numero</label>
                                <input type="text" class="form-control" id="inputEndereço" name="address[number]"
                                       value="{{Auth::user()->address->number}}" placeholder="1234 ">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNeighborhood">Bairro</label>
                                <input type="text" class="form-control" name="address[neighborhood]"
                                       id="inputNeighborhood" value="{{Auth::user()->address->neighborhood}}"
                                       placeholder="Bairro">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputComplement">Complemento</label>
                                <input type="text" class="form-control" name="address[complement]" id="inputComplement"
                                       value="{{Auth::user()->address->complement}}" placeholder="Complemento">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCidade">Cidade</label>
                                <input type="text" class="form-control" id="inputCidade" name="address[city]"
                                       value=" {{Auth::user()->address->city}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Estado</label>
                                <select id="inputState" class="form-control" name="address[state]"
                                        value=" {{Auth::user()->address->state}}">
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AM</option>
                                    <option>AP</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MG</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>PR</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>RS</option>
                                    <option>SC</option>
                                    <option>SE</option>
                                    <option>SP</option>
                                    <option>TO</option>
                                </select>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">CEP</label>
                                <input type="text" class="form-control" id="inputZip" name="address[zip_code]"
                                       value=" {{Auth::user()->address->zip_code}}">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Continue to Payment</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" id="step3" style="display: none">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <h4 class="card-title">Payment Information</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('billings-card-create') }}" id="formCC">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="credit_card">Credit Card</label>
                                    <input type="tel" class="form-control" id="credit_card"
                                           placeholder="4000 1234 1234 1234">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="expiration">Expiration</label>
                                    <input type="tel" class="form-control" id="expiration" placeholder="05 / 2029">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cvc">CVC</label>
                                    <input type="tel" class="form-control" id="cvc" placeholder="050" maxlength="4">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" id="btnSubmit" type="submit">
                            Submit Subscription
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/3.0.0/jquery.payment.min.js"></script>
    <script type='text/javascript'>
        var s = document.createElement('script');
        s.type = 'text/javascript';
        var v = parseInt(Math.random() * 1000000);
        s.src = 'https://sandbox.gerencianet.com.br/v1/cdn/841723a54fd283e758f72782896f708a/' + v;
        s.async = false;
        s.id = '841723a54fd283e758f72782896f708a';
        if (!document.getElementById('841723a54fd283e758f72782896f708a')) {
            document.getElementsByTagName('head')[0].appendChild(s);
        }
        ;$gn = {
            validForm: true, processed: false, done: {}, ready: function (fn) {
                $gn.done = fn;
            }
        };</script>
{{--    // TODO: Script Gerencianet modular--}}
    <script>
        $gn.ready(function (checkout) {
            $(document).ready(function () {
                $("#credit_card").payment('formatCardNumber');
                $("#expiration").payment('formatCardExpiry');
                $("#cvc").payment('formatCardCVC');


                $(".subscriptionBtn").click(function (e) {
                    e.preventDefault()
                    $(".subscriptionBtn").removeClass('selected');
                    $(this).addClass('selected')
                    $("#btnSelectPlan").removeAttr('disabled')
                })
                $("#btnSelectPlan").click(function () {
                    $("#step2").show();
                });

                $("#formUserInfo").submit(function (e) {
                    e.preventDefault()

                    $.ajax({
                        type: 'PUT',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                        },
                        success: function (data) {
                            toastr.success("Conta atualizada!")
                            $("#step3").show()
                        },
                        error: function (data) {
                            let errors = data.responseJSON.errors;
                            for (let i in errors) {
                                toastr.error(errors[i]);
                            }
                        }
                    });
                });

                $("#formCC").submit(function (e) {
                    $("#btnSubmit").attr('disabled', true)
                    e.preventDefault()
                    let cardNumber = $("#credit_card").val()
                    let brand = $.payment.cardType(cardNumber)
                    let cvv = $("#cvc").val()
                    let expiration = $("#expiration").val().split(' / ');
                    checkout.getPaymentToken({
                        brand: brand, // bandeira do cartão
                        number: cardNumber, // número do cartão
                        cvv: cvv, // código de segurança
                        expiration_month: expiration[0], // mês de vencimento
                        expiration_year: expiration[1] // ano de vencimento
                    }, function (error, response) {
                        if (error) {
                            toastr.error('Houve um erro na requisição! Tente novamente.');
                            return false;
                        }
                        let lastDigits = response.data.card_mask.replaceAll('X', '')
                        let payload = {
                            last_digits: lastDigits,
                            payment_token: response.data.payment_token,
                            brand: brand,
                            plan_id: $(".selected").data('id')
                        };

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('billings-payments-create') }}',
                            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')},
                            data: payload,
                            success: function (data) {
                                toastr.success("Pagamento pré-processado! Em alguns minutos sua assinatura será ativa.")
                                setTimeout(() => {
                                    window.location.href = '{{ route('dashboard') }}'
                                }, 4000)
                            },
                            error: function (data) {
                                $("#btnSubmit").removeAttr('disabled')
                                let errors = data.responseJSON.errors;
                                for (let i in errors) {
                                    toastr.error(errors[i]);
                                }
                            }
                        });
                    });
                });

            });
        });
    </script>
@endsection
