@extends("components/layout-guest")
@section("form")
<form action="/register" method="POST" class="register-form" name="register-form" novalidate>
    @csrf
    <p class="text-2xl font-bold text-center">Create a New Account</p>
    <div class="flex w-full justify-center mt-4">
        <button id="register-step-1" class="register-step rounded-full w-fit p-2 px-4 mx-4 text-white bg-bgFifth">
            1
        </button>
        <button id="register-step-2" class="register-step rounded-full w-fit p-2 px-4 mx-4  text-white bg-mygrey-2" disabled>
            2
        </button>
        <button id="register-step-3" class="register-step rounded-full w-fit p-2 px-4 mx-4 text-white bg-mygrey-2" disabled>
            3
        </button>
        <button id="register-step-4" class="register-step rounded-full w-fit p-2 px-4 mx-4 text-white bg-mygrey-2" disabled>
            4
        </button>

        <button id="register-step-5" class="register-step rounded-full w-fit p-2 px-4 mx-4 text-white bg-mygrey-2" disabled>
            4
        </button>
    </div>
    
    <div id="register-container-1" class="active-register register-container">
        <div class="w-full mt-6">
            <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="text" name="name" id="name" placeholder="Name" value={{old('name')}}>
        </div>
        <div class="w-full mt-6">
            <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="email" name="email" id="email" placeholder="Email" value={{old('email')}}>
        </div>
        <div class="w-full mt-6">
            <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="w-full mt-6">
            <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="password" name="password_confirmation" id="password_confirmation" placeholder='Confirm Password'>
        </div>

        <div class="w-full mt-6">
            <button class="rounded-md border-none w-full bg-bgFourth cursor-pointer hover:bg-gradient-to-br from-bgThird to-bgFourth transition duration-500 ease-in-out text-white py-2 px-4 next-button" type="submit" name="" id="">
                Next
            </button>
        </div>
    </div>

    <div class="register-container hidden" id="register-container-2">
        <div class="w-full mt-6 flex items-center">           
            <label for="gender" class="font-semibold">Gender</label>
            <select autocomplete="Male" name="gender" id="gender" class="bg-bgSecondary rounded-md border-none w-full ml-4 py-2 px-4 appearance-none">
                <option value="" selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        
        <div class="w-full mt-6 flex items-center">
            <label for="age" class="font-semibold">Age</label>
            <select name="age" id="age" class="bg-bgSecondary rounded-md border-none w-full ml-4 py-2 px-4 appearance-none">
                <option value="" selected>Choose Age Category</option>
                @foreach (\App\Models\Age::all() as $age_option)
                    <option value={{$age_option->id}}>{{$age_option->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full mt-6 flex items-center">
            <label for="education" class="font-semibold">Education</label>
            <select name="education" id="education" class="bg-bgSecondary rounded-md border-none w-full ml-4 py-2 px-4 appearance-none">
                <option value="" selected>Choose Education</option>
                @foreach (\App\Models\Education::all() as $education_option)
                    <option value={{$education_option->id}}>{{$education_option->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full mt-6 flex">
            <label for="occupation" class="font-semibold items-center">Occupation</label>
            <select name="occupation" id="occupation" class="bg-bgSecondary rounded-md border-none w-full ml-4 py-2 px-4 appearance-none">
                <option value="" selected>Choose Occupation</option>
                @foreach (\App\Models\Occupation::all() as $occupation_option)
                    <option value={{$occupation_option->id}}>{{$occupation_option->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full mt-6">
            <button class="rounded-md border-none w-full bg-bgFourth cursor-pointer hover:bg-gradient-to-br from-bgThird to-bgFourth transition duration-500 ease-in-out text-white py-2 px-4 next-button" type="submit" name="" id="">
                Next
            </button>
        </div>
    </div>

    <div class="register-container hidden" id="register-container-3">
        @foreach (\App\Models\ViewpointType::take(3)->get() as $viewpoint_type)
            <div class="w-full mt-6">       
                <label for="viewpoint_{{ $viewpoint_type->id }}" class="w-full">{{ $viewpoint_type->name }}</label>
                <select name="viewpoint_{{ $viewpoint_type->id }}" id=""
                    class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none text-sm">
                    <option value=1>Effective</option>
                    <option value=0 selected>Not Effective</option>
                </select>
            </div>
        @endforeach
        <div class="w-full mt-6">
            <button class="rounded-md border-none w-full bg-bgFourth cursor-pointer hover:bg-gradient-to-br from-bgThird to-bgFourth transition duration-500 ease-in-out text-white py-2 px-4 next-button" type="submit" name="" id="">
                Next
            </button>
        </div>
    </div>

    <div class="register-container hidden" id="register-container-4">
        @foreach (\App\Models\ViewpointType::skip(3)->take(3)->get() as $viewpoint_type)
            <div class="w-full mt-6">       
                <label for="viewpoint_{{ $viewpoint_type->id }}" class="w-full">{{ $viewpoint_type->name }}</label>
                <select name="viewpoint_{{ $viewpoint_type->id }}" id=""
                    class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none text-sm">
                    <option value=1>Effective</option>
                    <option value=0 selected>Not Effective</option>
                </select>
            </div>
        @endforeach
        <div class="w-full mt-6">
            <button class="rounded-md border-none w-full bg-bgFourth cursor-pointer hover:bg-gradient-to-br from-bgThird to-bgFourth transition duration-500 ease-in-out text-white py-2 px-4 next-button" type="submit" name="" id="">
                Next
            </button>
        </div>
    </div>

    <div class="register-container hidden" id="register-container-5">
        @foreach (\App\Models\ViewpointType::skip(6)->take(2)->get() as $viewpoint_type)
            <div class="w-full mt-6">       
                <label for="viewpoint_{{ $viewpoint_type->id }}" class="w-full">{{ $viewpoint_type->name }}</label>
                <select name="viewpoint_{{ $viewpoint_type->id }}" id=""
                    class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none text-sm">
                    <option value=1>Effective</option>
                    <option value=0 selected>Not Effective</option>
                </select>
            </div>
        @endforeach
        <div class="w-full mt-6">
            <input class="rounded-md border-none w-full bg-bgFourth cursor-pointer hover:bg-gradient-to-br from-bgThird to-bgFourth transition duration-500 ease-in-out text-white py-2 px-4" type="submit" name="" id="" value="Register">
        </div>
    </div>
        
</form>

<div class="w-full mt-6 text-end">
    <a href="/login" class="text-regal-blue hover:underline">Already have an Account</a>
</div>

<script>

    let lastStep = 5

    $(document).ready(function() {
        $(".next-button").click(function(e){
            e.preventDefault();
            currContainer = $('.active-register')
            currIdx = currContainer.attr("id").slice(-1)
            console.log("currIdx: " + currIdx);

            currContainer.removeClass('active-register')
            currContainer.addClass("hidden")

            currIdx = parseInt(currIdx)+1;
            currContainer = $("#register-container-" + currIdx);
            $("#register-step-" + currIdx).removeClass("bg-mygrey-2").addClass("bg-bgFifth");

            currContainer.addClass('active-register');
            currContainer.removeClass("hidden");

            $("#register-step-" + currIdx).prop("disabled", false)
        });

        $(".register-step").click(function(e){
            e.preventDefault()
            currStep = $(this)
            console.log(currStep)
            currIdx = currStep.attr("id").slice(-1)
            console.log("currIdx: " + currIdx);
            console.log(lastStep);

            if(currIdx < lastStep-1){
                for(let i = lastStep; i >= currIdx; i--){
                    $("#register-step-" + i).addClass("bg-mygrey-2").removeClass("bg-bgFifth");
                    $("#register-step-" + i).prop("disabled", true)
                    $("#register-step-" + i).prop("disabled", false)
                }

            }
            else if(currIdx == lastStep-1){
                $("#register-step-3").addClass("bg-mygrey-2").removeClass("bg-bgFifth");
                $("#register-step-3").prop("disabled", true)
            }

            $(".register-container").removeClass("active-register").addClass("hidden")
            $("#register-container-" + currIdx).removeClass("hidden").addClass("active-register");
            $("#register-step-" + currIdx).removeClass("bg-mygrey-2").addClass("bg-bgFifth");
            

        })

    })

</script>

@endsection()