<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Code Test')</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts tailwind-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Local CSS -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <div class="grid grid-cols-12">
        <header class="col-span-2">
            <nav class="flex flex-col justify-start items-start bg-dark text-white h-full p-2">
                <div class="my-1 p-2 w-full flex items-center" style="border-bottom: 1px solid white;">
                    <img src="{{ asset('images/icons/avatar.svg') }}" class="h-10 inline rounded-full" alt="avatar">
                    <div class="inline ml-3">
                        <h5 class="block">Hi, {{ ucwords(Auth::user()->name) }}</h5>
                        <h6 class="block">({{ucwords(Auth::user()->degree)}})</h6>
                    </div>
                </div>
                <div class="my-1 p-2 hover:text-secondary w-full rounded {{ Session::get('menu-active') == 'beranda' ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <a class="ml-2" href="/">Beranda</a>
                </div>
                <div class="my-1 p-2 hover:text-secondary w-full rounded {{ Session::get('menu-active') == 'reimbursement' ? 'active' : '' }}">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    <a class="ml-2" href="/reimbursement">Reimbursement</a>
                </div>
                @can('crudUser', App\Models\User::class)
                    <div class="my-1 p-2 hover:text-secondary w-full rounded {{ Session::get('menu-active') == 'users' ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <a class="ml-2" href="/users">Pengguna</a>
                    </div>
                @endcan
                <div class="my-1 p-2 w-full rounded bg-danger">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <form method="post" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="ml-2" href="{{ route('logout') }}">Keluar</button>
                    </form>
                </div>
            </nav>
        </header>

        <main class="col-span-10 p-2 bg-dark text-white">
            @yield('content')
        </main>
    </div>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/a78952d076.js" crossorigin="anonymous"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
