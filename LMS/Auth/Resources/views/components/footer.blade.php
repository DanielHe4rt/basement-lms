<footer class="footer">
    <div class="container">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="{{ route('landing') }}">
                        {{ config('app.name') }}
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright pull-right">
            © {{ config('app.name') . ' ' . date('Y') }}
            made with <i class="fa fa-heart heart"></i> by <a href="https://github.com/danielhe4rt">DanielHe4rt</a>
        </div>
    </div>
</footer>
