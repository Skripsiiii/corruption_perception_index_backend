<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <body class="antialiased h-screen w-screen fixed top-0 ">
        <div class="big-Container h-screen relative">
            <div id="navbar-hidden" class="absolute w-screen h-screen bg-black opacity-50 z-10 hidden lg:hidden"></div>
            @include('components.utility.header.sidebar')
            <div id="navbar" class=" main-container pl-0 lg:pl-20 w-full flex flex-col ease-in-out duration-300">
                @include('components.utility.header.navbar')
                <div id="content-container" class="w-full mr-0 px-10 py-8 pb-24 overflow-scroll h-min-content">
                    @yield("content")
                </div>
            </div>
        </div>

    </body>

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
</html>
