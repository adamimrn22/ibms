<div class="navbarBorder">
    <nav class="container">
        <ul class="nav  bg-light">

            <li class="nav-item  ">
                <a class="nav-link text-dark"> </a>
            </li>

            <li class="nav-item  ">
                <a class="nav-link  {{ request()->routeIs('user.homepage') ? 'activeRoute' : ' text-dark' }} "
                    href="{{ route('user.homepage') }}">
                    Halaman Utama
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link  {{ Str::contains(request()->path(), 'AlatTulis') ? 'activeRoute' : 'text-dark' }} "
                    href="{{ route('AlatTulis.index') }}">Pinjaman
                    Alat Tulis</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Pinjaman Barang IT</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" href="#">Tempahan Kereta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="/sda">Tempahan Ruang</a>
            </li>

            <li class="nav-item ms-auto">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-power me-50">
                            <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                            <line x1="12" y1="2" x2="12" y2="12"></line>
                        </svg>
                        Log Keluar
                    </button>
                </form>

            </li>
        </ul>
    </nav>
</div>
