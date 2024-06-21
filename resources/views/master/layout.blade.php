<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CegahKorupsi</title>
    <link rel="stylesheet" href={{ asset('css/app.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src={{ asset('js/app.js') }}></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
</head>

<body>
    <div class="big-Container h-screen relative">

        @auth
            <div id="navbar-hidden" class="absolute w-screen h-screen bg-black opacity-50 z-10 hidden lg:hidden"></div>
            @include('components.utility.header.sidebar')
        @endauth

        @if (Auth::guest())
            <div id="navbar" class=" main-container h-min-content overflow-scroll pl-0 w-full flex flex-col ease-in-out duration-300">
        @else
            <div id="navbar" class=" main-container h-min-content overflow-scroll pl-0 lg:pl-20 w-full flex flex-col ease-in-out duration-300">
        @endif

            @include('components.utility.header.navbar')

                @yield('content')

            <footer class="w-[90%] mx-auto flex justify-center flex-col items-center mt-3 text-sm text-semibold border-0 mb-4 pt-16">
                <p>Copyright &copy; 2023 - RIG EduTech</p>
                <p>Corruption Perception Index</p>
            </footer>
        </div>
    </div>



    @if(session("success"))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{session("success")}}'
            })
        </script>
    @endif
    @if($errors->any())
        <script>
            Toast.fire({
                    icon: 'error',
                    title: '{{$errors->first()}}'
                })
        </script>
    @endif

    <script>
        var desktopCheck = false;
        var mobileCheck = false;

        var desktop = document.getElementById("desktop");
        var mobile = document.getElementById("mobile");
        var sidebar = document.getElementById("sidebar");
        var navbar = document.getElementById("navbar");
        var navbarHidden = document.getElementById("navbar-hidden");

        desktop.addEventListener("click", function() {
            if (desktopCheck == false) {
                sidebar.classList.remove("lg:w-20");
                sidebar.classList.add("lg:w-60");

                navbar.classList.remove("lg:pl-20")
                navbar.classList.add("lg:pl-60")
                desktopCheck = true
            } else {
                sidebar.classList.remove("lg:w-60");
                sidebar.classList.add("lg:w-20");

                navbar.classList.remove("lg:pl-60")
                navbar.classList.add("lg:pl-20")
                desktopCheck = false
            }
        });

        mobile.addEventListener("click", function() {
            if (mobileCheck == false) {
                sidebar.classList.remove("-left-full");
                sidebar.classList.add("-left-0");

                navbarHidden.classList.remove("hidden")
                navbarHidden.classList.add("block")
                mobileCheck = true
            }
            // else {
            //     sidebar.classList.remove("-left-full");
            //     sidebar.classList.add("-left-0");

            //     // navbar.classList.remove("pl-60")
            //     // navbar.classList.add("pl-20")
            //     mobileCheck = false
            // }
        });

        navbarHidden.addEventListener("click", function() {
                navbarHidden.classList.remove("block")
                navbarHidden.classList.add("hidden")
                sidebar.classList.remove("-left-0");
                sidebar.classList.add("-left-full");
                mobileCheck = false
        });
    </script>
</body>

</html>
