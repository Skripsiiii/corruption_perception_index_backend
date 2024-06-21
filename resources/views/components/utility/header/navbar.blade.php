@auth
    <div class="z-50 flex justify-between shadow-sm drop-shadow-md px-6 py-4 box-border w-full bg-white">
        <div class="left text-2xl">
            @if (Auth::user()->role_id != 3)
                <i id="desktop" class="text-myblue-2 cursor-pointer hidden lg:block uil uil-bars"></i>
                <i id="mobile" class="text-myblue-2 uil uil-bars lg:hidden"></i>
            @else 
                <i id="desktop" class="text-bgThird cursor-pointer hidden lg:block uil uil-bars"></i>
                <i id="mobile" class="text-bgThird uil uil-bars lg:hidden"></i>
            @endif
        </div>
        <div class="right text-2xl flex items-center gap-2 z-50">
            <div class="dropdown dropdown-bottom dropdown-end z-50">
                <label tabindex="0" class="flex justify-center items-center gap-2 cursor-pointer">
                    <p class='text-sm font-bold'>Hello, {{Auth::user()->name}}</p>
                    @if (Auth::user()->role_id != 3)
                        <i class="uil uil-setting text-myblue-2"></i>
                    @else 
                        <i class="uil uil-setting text-bgThird"></i>
                    @endif
                    
                </label>
                <ul class="z-50 dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                    @if (Auth::user()->role_id == 3)
                        <li class="z-50"><a href="{{route('editProfileView')}}">My Profile</a></li>
                        <li class="z-50"><a href="{{route('changePasswordView')}}">Change Password</a></li>
                        <hr class="border-t-2 border-slate-200">
                        <li class="z-50"><a href="{{route('domicilieView')}}">My Domicile</a></li>
                        <li class="z-50"><a href="{{route('viewPointView')}}">My View Point</a></li>
                        <hr class="border-t-2 border-slate-200">
                        <li class="z-50"><a href="{{route('my_questionnaire')}}">My Questionnaire</a></li>
                    @else
                        <li class="z-50"><a href="/changePassword">Change Password</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endauth

@guest
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
        <div class="flex items-center w-fit px-0">
            <a href="/login" id="" class=" cursor-pointer mx-2">
                <p class="font-bold text-white rounded-md px-2 py-1 bg-bgThird hover:bg-bgFifth text-md">Login</p>
            </a>
            <a href="/register" id="" class=" cursor-pointer mx-2">
                <p class="font-bold text-white rounded-md px-2 py-1 bg-bgThird hover:bg-bgFifth text-md">Register</p>
            </a>
        </div>
    </div>
@endguest


