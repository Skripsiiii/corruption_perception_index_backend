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
        <div class="w-full flex bg-white drop-shadow-lg py-4 px-2 items-center justify-between">
            <div class="flex items-center ">
                <div class="min-w-16 flex justify-center h-full items-center box-border">
                    <div class="font-bold text-md rounded-md p-2 bg-bgFourth text-white">
                        CPI
                    </div>
                </div>
                <a href="/" id="left-navbar-container" class="w-1/5 cursor-pointer">
                    <p class="hidden md:block font-bold text-bgFourth text-xl w-full whitespace-nowrap">Corruption Perception Index</p>
                </a>
            </div>
        </div>
        <div class="w-full min-h-screen bg-gradient-to-br from-bgThird to-bgThird py-20 ">
            <div class="w-20 h-20 absolute top-23 -left-10 rounded-full bg-gradient-to-b from-bgThird to-bgFourth"></div>
            <div class="w-80 h-80 absolute -bottom-20 -left-10 rounded-full bg-gradient-to-br from-bgThird to-bgFourth opacity-60"></div>
            <div class="w-40 h-40 absolute top-80 -right-10 rounded-full bg-gradient-to-b from-bgThird to-bgFourth opacity-40"></div>
            <div class="w-2/3 m-auto items-center">
                <div class="w-full md:w-2/3 mx-auto text-white">
                    <div>
                        <div class="text-center">
                            <p class="text-3xl font-semibold mb-8 md:mb-6 ml-2">Cegah Korupsi</p>
                        </div>
                    </div>
                </div>
                <div id="form-container" class="w-full md:w-2/3 mx-auto rounded-md drop-shadow-md bg-white py-4 px-8 lg:px-16">
                    <form action="" method="post">
                        @csrf
                        <p class="text-2xl font-bold text-center">Forgot Your Password?</p>
                        <p class="text-center my-4">We will send you email to reset your password.</p>
                        <div class="w-full mt-6">
                            <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="text" name="email" id="" placeholder="Email" value={{old('email')}}>
                        </div>
                        <div class="w-full mt-6">
                            <input class="rounded-md border-none w-full bg-bgFourth hover:bg-bgThird transition duration-500 ease-in-out cursor-pointer text-white py-2 px-4" type="submit" name="" id="" value="Send Email">
                        </div>
                    </form>
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
