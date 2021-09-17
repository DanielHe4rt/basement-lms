<div class="sidebar" data-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
            LMS
        </a>
        <a href="#" class="simple-text logo-normal">
            {{ config('app.name') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="https://placehold.it/300x300">
            </div>
            <div class="user-info">
                <p>
                    <span class="username">
                        {{ auth()->user()->name }}<br>
                         {{ '@' .  auth()->user()->username }}
                    </span><br><br>
                    @if(auth()->user()->plan_id)
                    <p class="username">
                            Plano: <br><span class="text-warning">{{ auth()->user()->plan->name }}</span>
                    </p>
                    @else
                        <p class="username">
                            Sem plano ativo
                            <a href="{{ route('billings-subscriptions-view') }}" class="text-warning">Clique aqui para assinar</a>
                        </p>
                    @endif
                </p>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="material-icons">house</i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#userArea">
                    <i class="material-icons">person</i>
                    <p> Area do Usuário
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="userArea">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Perfil </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="sidebar-mini"> MC </span>
                                <span class="sidebar-normal"> Meus Cursos </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @role('admin')
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p> Instrutor
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="componentsExamples" style="">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('instructor-courses') }}">
                                <span class="sidebar-mini"> C </span>
                                <span class="sidebar-normal"> Cursos </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#paymentsAndBillings">
                    <i class="material-icons">credit_card</i>
                    <p> Pagamentos & Planos
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="paymentsAndBillings" style="">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-invoices') }}">
                                <span class="sidebar-mini"> C </span>
                                <span class="sidebar-normal"> Cobranças </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-card-view') }}">
                                <span class="sidebar-mini"> CC </span>
                                <span class="sidebar-normal"> Cartão de Crédito </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-subscriptions-view') }}">
                                <span class="sidebar-mini"> A </span>
                                <span class="sidebar-normal"> Assinaturas </span>
                            </a>
                        </li>

                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-providers-list') }}">
                                <span class="sidebar-mini"> PP </span>
                                <span class="sidebar-normal"> Provedores de Pagamento </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-plans-list') }}">
                                <span class="sidebar-mini"> PS </span>
                                <span class="sidebar-normal"> Planos e Assinaturas </span>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth-logout') }}">
                    <i class="material-icons">logout</i>
                    <p>
                        Sair
                    </p>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidebar-background"
         style="/*! background-image: url(&quot;../assets/img/sidebar-1.jpg&quot;); */"></div>
</div>
