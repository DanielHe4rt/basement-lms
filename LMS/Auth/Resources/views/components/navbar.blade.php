<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="/"> {{ config('app.name') }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="../dashboard.html" class="nav-link">
                        <i class="material-icons">dashboard</i>
                        Home
                        <div class="ripple-container"></div>
                    </a>
                </li>
                <li class="nav-item  active ">
                    <a href="../pages/register.html" class="nav-link">
                        <i class="material-icons">person_add</i>
                        Register
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="../pages/login.html" class="nav-link">
                        <i class="material-icons">fingerprint</i>
                        Login
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
