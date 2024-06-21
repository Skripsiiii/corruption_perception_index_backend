<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CegahKorupsi</title>
        <link rel="stylesheet" href={{asset('css/app.css')}}>
        <script src={{asset('js/app.js')}}></script>
        <style>
            body {
                font-family: sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-200 min-h-screen w-screen top-0 pb-10 bg-gradient-to-br from-bgThird to-bgThird">
        @include('components.utility.header.navbar')
        <div class="w-full min-h-screen bg-gradient-to-br from-bgThird to-bgThird py-20 ">
            <div class="w-20 h-20 absolute top-23 -left-10 rounded-full bg-gradient-to-b from-bgThird to-bgFourth"></div>
            <div class="w-80 h-80 absolute -bottom-20 -left-10 rounded-full bg-gradient-to-br from-bgThird to-bgFourth opacity-60"></div>
            <div class="w-40 h-40 absolute top-80 -right-10 rounded-full bg-gradient-to-b from-bgThird to-bgFourth opacity-40"></div>
            <div class="w-2/3 m-auto items-center">
                <div class="w-full md:w-2/3 mx-auto text-white">
                    <div>
                        <div class="text-center">
                            <p class="text-3xl font-semibold mb-8 md:mb-6 ml-2">Corruption Perception Index</p>
                        </div>
                        @if (request()->is("login") || request()->is('login/*'))
                            <p class="hidden md:block text-center mb-8 mx-5">
                                Corruption Perceptions Index shows the level of corruption in a region based on public perceptions from scale of 0 to 100. Participate in filling the corruption perception questionnaire to get the corruption level in your living area.
                            </p>
                        @endif
                        
                    </div>
                </div>
                <div id="form-container" class="w-full md:w-2/3 mx-auto rounded-md drop-shadow-md bg-white py-4 px-8 lg:px-16 lg:pl-24">
                    @yield("form")
                    
                    <div class="invisible md:visible flex justify-center mb-4 absolute -bottom-10 left-20">
                        <img class="max-h-10 min-w-fit" src="{{asset('images/wad_of_money.png')}}" alt="">
                    </div>
                    <div class="invisible md:visible flex justify-center mb-4 absolute -bottom-16 -left-10 ">
                        <img class="max-h-36 min-w-fit -rotate-12" src="{{asset('images/black_wallet_with_money.png')}}" alt="">
                    </div>
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
