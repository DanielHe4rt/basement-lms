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
                    <span class="level">
                        Lvl. 1
                    </span>
                    <span class="username">
                        {{ auth()->user()->name }}
                    </span>
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

            @role('admin')
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p> Courses & Stuff
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="componentsExamples" style="">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('instructor-courses') }}">
                                <span class="sidebar-mini"> C </span>
                                <span class="sidebar-normal"> Courses </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endrole
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#paymentsAndBillings">
                    <i class="material-icons">credit_card</i>
                    <p> Payments & Billings
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="paymentsAndBillings" style="">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-card-view') }}">
                                <span class="sidebar-mini"> CC </span>
                                <span class="sidebar-normal"> Credit Card </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-providers-list') }}">
                                <span class="sidebar-mini"> S </span>
                                <span class="sidebar-normal"> Subscription </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-providers-list') }}">
                                <span class="sidebar-mini"> I </span>
                                <span class="sidebar-normal"> Invoices </span>
                            </a>
                        </li>
                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-providers-list') }}">
                                <span class="sidebar-mini"> PP </span>
                                <span class="sidebar-normal"> Payment Providers </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('billings-plans-list') }}">
                                <span class="sidebar-mini"> PS </span>
                                <span class="sidebar-normal"> Plans and Subscriptions </span>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </div>
            </li>

        </ul>
    </div>
    <div class="sidebar-background"
         style="/*! background-image: url(&quot;../assets/img/sidebar-1.jpg&quot;); */"></div>
</div>
