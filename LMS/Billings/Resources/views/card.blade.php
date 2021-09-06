@extends('lms.templates.dashboard')
@section('breadcrumb')
    <ol class="navbar-brand breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Cursos</a></li>
        <li class="breadcrumb-item">Payments</li>
        <li class="breadcrumb-item">Plans</li>
    </ol>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">
                                My Credit Card
                                @if($card)
                                    <span class="float-right text-primary">
                                        <i class="fab fa-cc-{{$card->brand}}"></i>
                                        ({{ $card->last_digits }})
                                    </span>
                                @endif
                            </h4>

                        </div>
                    </div>
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
                        <button class="btn btn-primary btn-block" type="submit">
                            {{$card ? 'Update Card' : 'Insert Card'}}
                        </button>
                        @if($card)
                            <button id="deleteCards" class="btn btn-block  btn-danger" type="submit">
                                Delete Card
                            </button>
                        @endif
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
    <script>
        $gn.ready(function (checkout) {
            $(document).ready(function () {
                $(".btnPlanModal").click(function () {
                    $("#newPlanModal").modal('toggle')
                });
                $("#credit_card").payment('formatCardNumber');
                $("#expiration").payment('formatCardExpiry');
                $("#cvc").payment('formatCardCVC');

                $("#formCC").submit(function (e) {
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
                            toastr.error('deu merda');
                            return false;
                        }
                        let lastDigits = response.data.card_mask.replaceAll('X','')
                        let payload = {
                            last_digits: lastDigits,
                            card: response.data.payment_token,
                            brand: brand
                        };
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                            },
                            data: payload,
                            success: function (data) {
                                toastr.success("Plano criado!")
                            },
                            error: function (data) {
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

        $("#deleteCards").click(function(e) {
            e.preventDefault()
            $.ajax({
                type: 'DELETE',
                url: '{{ route('billings-card-delete') }}',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                success: function (data) {
                    toastr.success("Cartão desvinculado!")
                },
                error: function (data) {
                    let errors = data.responseJSON.errors;
                    for (let i in errors) {
                        toastr.error(errors[i]);
                    }
                }
            });
        });
    </script>
@endsection
