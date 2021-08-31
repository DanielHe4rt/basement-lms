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
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                    <i class="material-icons">image</i>
                    <p> Pages
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/pricing.html">
                                <span class="sidebar-mini"> P </span>
                                <span class="sidebar-normal"> Pricing </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/rtl.html">
                                <span class="sidebar-mini"> RS </span>
                                <span class="sidebar-normal"> RTL Support </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/timeline.html">
                                <span class="sidebar-mini"> T </span>
                                <span class="sidebar-normal"> Timeline </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/login.html">
                                <span class="sidebar-mini"> LP </span>
                                <span class="sidebar-normal"> Login Page </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/register.html">
                                <span class="sidebar-mini"> RP </span>
                                <span class="sidebar-normal"> Register Page </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/lock.html">
                                <span class="sidebar-mini"> LSP </span>
                                <span class="sidebar-normal"> Lock Screen Page </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/user.html">
                                <span class="sidebar-mini"> UP </span>
                                <span class="sidebar-normal"> User Profile </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/error.html">
                                <span class="sidebar-mini"> E </span>
                                <span class="sidebar-normal"> Error Page </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @role('admin')
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p> Admin Panel
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
        </ul>
    </div>
    <div class="sidebar-background"
         style="/*! background-image: url(&quot;../assets/img/sidebar-1.jpg&quot;); */"></div>
</div>
