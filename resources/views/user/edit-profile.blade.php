@extends('components/layout')
@section('content')

<div class="mx-auto mt-10 mb-20 w-1/2">
    <ul class="flex">
        <li class="-mb-px mr-1">
            <a class="tab-title inline-block rounded-t py-2 px-4 text-blue-700 font-semibold bg-white hover:bg-gradient-to-br hover:from-white hover:to-mygrey-0" href="#tab1">Edit Profile</a>
        </li>
        <li class="mr-1">
            <a class="tab-title bg-mygrey-0 hover:bg-gradient-to-br hover:from-white hover:to-mygrey-0 rounded-t hover:rounded-t inline-block py-2 px-4" href="#tab2">Domicile History</a>
        </li>
        <li class="mr-1">
            <a class="tab-title bg-mygrey-0 hover:bg-gradient-to-br hover:from-white hover:to-mygrey-0 rounded-t hover:rounded-t inline-block py-2 px-4" href="#tab3">Response History</a>
        </li>
        <li class="mr-1">
            <a class="tab-title bg-mygrey-0 hover:bg-gradient-to-br hover:from-white hover:to-mygrey-0 rounded-t hover:rounded-t inline-block py-2 px-4" href="#tab4">Account Setting</a>
        </li>
        <li class="mr-1">
            <a class="tab-title bg-mygrey-0 hover:bg-gradient-to-br hover:from-white hover:to-mygrey-0 rounded-t hover:rounded-t inline-block py-2 px-4" href="#tab5">Viewpoint Data</a>
        </li>
    </ul>
    <div id="tab1" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md">
        <p class="font-bold text-3xl">Edit Profile</p>
        <form action="/updateProfile" class="" method="POST">
            @csrf
            <div class="w-full mt-4">
                <div class="">
                    <div class="mt-4">
                        <label for="" class="font-semibold">Name</label>
                        <br>
                        <input type="text" name="name" id="" value={{Auth()->user()->name}} class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Gender</label>
                        <br>
                        <select name="gender" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none">
                            @if (Auth::guard("participant")->user()->gender == "Male")
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                            @else
                                <option value="Male">Male</option>
                                <option value="Female" selected>Female</option>
                            @endif
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Age Category</label>
                        <br>
                        <select name="age" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none">
                            <option value="" selected>Choose Age Category</option>
                            @foreach (\App\Models\Age::all() as $age_option)
                                @if (Auth::guard("participant")->user()->age_id == $age_option->id)
                                    <option value={{$age_option->id}} selected>{{$age_option->name}}</option>
                                @else
                                    <option value={{$age_option->id}}>{{$age_option->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Last Education</label>
                        <br>
                        <select name="education" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none">
                            <option value="" selected>Choose Last Education</option>
                            @foreach (\App\Models\Education::all() as $education_option)
                                @if (Auth::guard("participant")->user()->education_id == $education_option->id)
                                    <option value={{$education_option->id}} selected>{{$education_option->name}}</option>
                                @else
                                    <option value={{$education_option->id}}>{{$education_option->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Occupation</label>
                        <br>
                        <select name="occupation" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none">
                            <option value="" selected>Choose Last Occupation</option>
                            @foreach (\App\Models\Occupation::all() as $occupation_option)
                                @if (Auth::guard("participant")->user()->occupation_id == $occupation_option->id)
                                    <option value={{$occupation_option->id}} selected>{{$occupation_option->name}}</option>
                                @else
                                    <option value={{$occupation_option->id}}>{{$occupation_option->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="rounded-md px-4 py-2 bg-myblue-2 text-white font-bold hover:bg-gradient-to-br from-myblue-2 to-myblue-3">Update</button>
            </div>
        </form>
    </div>
    <div id="tab2" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md hidden">
        <p class="font-bold text-3xl">Domicile History</p>
        <div class="">
            @foreach (Auth::guard("participant")->user()->domiciles as $domicile)
            <div class="mt-4">
                <p class="text-lg">{{$domicile->city->name}}, {{$domicile->city->province->name}}</p>
                <p class=""><i>Since</i> <b>{{\Carbon\Carbon::parse($domicile->start_date)->format('Y-m-d')}}</b> <i>to</i> <b>{{$domicile->end_date ?? 'Now'}}</b></p>
            </div>

            @endforeach
        </div>
        <div class="mt-4 text-end">
            <button type="submit" id="add-domicile-button" class="rounded-md px-4 py-2 bg-myblue-2 text-white font-bold hover:bg-gradient-to-br from-myblue-2 to-myblue-3">+ Add Domicile</button>
        </div>
    </div>

    <div id="tab3" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md hidden">
        <p class="font-bold text-3xl">Response History</p>

        <div class="">
            @foreach (Auth::guard("participant")->user()->responses()->orderBy("created_at", "desc")->get() as $response)
              <div class="mt-4">
                  <div class="flex items-center">
                    <p class="text-lg">{{$response->questionnaire->year}} Questionnaire</p>
                    <div class="rounded-full ml-2 px-2 py-1 bg-myblue-0 text-myblue-2 text-xs font-bold">CPI Score {{$response->corruption_index}} / 10</div>
                  </div>
                  <p class="text-md">{{$response->city->province->name}}, {{$response->city->name}}</p>
                  <p class="text-sm italic">Responded at {{($response->created_at)}}</p>
              </div>
            @endforeach
            @if (Auth::guard("participant")->user()->responses->count() == 0)
              <div class="mt-4 text-center">
                <p>There's no response history</p>
              </div>
            @endif
            <div class="mt-4 text-end">
                <a href="/questionnaire" class="text-myblue-2 hover:underline">Fill Questionnaire</a>
            </div>
        </div>
    </div>



    <div id="tab4" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md hidden">
        <p class="font-bold text-3xl">Account Setting</p>
        <form action="/changePassword" class="" method="POST">
            @csrf
            <div class="w-full mt-4">
                <div class="">
                    <div class="mt-4">
                        <label for="" class="font-semibold">Email</label>
                        <br>
                        <input type="text" name="" id="" value={{Auth::guard("participant")->user()->email}} disabled class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Current Password</label>
                        <br>
                        <input type="password" name="current_password" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">New Password</label>
                        <br>
                        <input type="password" name="password" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Confirm Password</label>
                        <br>
                        <input type="password" name="password_confirmation" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <button type="submit" class="rounded-md px-4 py-2 bg-myblue-2 text-white font-bold hover:bg-gradient-to-br from-myblue-2 to-myblue-3">Update</button>
            </div>
        </form>
    </div>

    <div id="tab5" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md hidden">
        <p class="font-bold text-3xl">Viewpoints Data</p>

        <div class="">
            @foreach (\App\Models\ViewpointType::all() as $viewpoint_type)
            <form action="/" class="" method="POST">
                @csrf
                <div class="mt-4">
                    <div class="items-center">
                        <p class="text-justify">{{$viewpoint_type->name}}</p>
                        <select name="viewpoint" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none">
                            @if (empty(\App\Models\Viewpoint::where("participant_id", Auth::guard("participant")->user()->id)->where("viewpoint_type_id", $viewpoint_type->id)->first()))
                                <option value="" selected>Choose Answer</option>
                                <option value=1>Effective</option>
                                <option value=0>Not Effective</option>
                            @elseif(\App\Models\Viewpoint::where("participant_id", Auth::guard("participant")->user()->id)->where("viewpoint_type_id", $viewpoint_type->id)->first()->is_effective)
                                <option value=1 selected>Effective</option>
                                <option value=0>Not Effective</option>
                            @else
                            <option value=1>Effective</option>
                            <option value=0 selected>Not Effectve</option>
                            @endif
                        </select>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>

</div>

<div id="add-domicile-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/3 m-auto mt-20 mx-auto py-4 px-6">
        <p class="text-2xl font-bold text-center">Add New Domicile</p>
        <div class="mt-4">
            <select name="" id="provinceFilter" class="bg-mygrey-0 w-full mr-4 py-2 px-4 appearance-none">
                <option value="0">Choose Province</option>
                @foreach (App\Models\Province::all() as $province_option)
                      <option value={{$province_option->id}} {{isset($province) && $province_option->id == $province->id ? "selected" : ""}} >{{$province_option->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="mt-4">
            <select name="" id="cityFilter" class="w-full bg-mygrey-0 mr-4 py-2 px-4 appearance-none">
                <option value="0" selected>Choose City</option>
            </select>
        </div>
        <div class="mt-4">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="domicileStartDate" class="w-full bg-mygrey-0 mr-4 py-2 px-4" placeholder="Start Date">
        </div>
        <div>
            <x-popups.error-message/>
        </div>
        <div class="justify-center text-center text-white w-full mt-6">
            <div class="mt-4 text-center justify-center flex items-center">
                <button id="submit-add-domicile" class="bg-myblue-2 hover:bg-gradient-to-br from-myblue-2 to-myblue-3 transition duration-500 ease-in-out rounded-md py-1 px-3 ml-2">Add Domicile</button>
            </div>
            <div class="mt-4 text-center">
                <x-buttons.cancel-button/>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=>{
        $(".tab-title").click(function(){
        $(".tab-content").hide();
        $(".tab-title").removeClass("bg-white font-semibold").addClass("bg-myblue-0");
        $($(this).attr("href")).show(200);
        $(this).addClass("bg-white text-black font-semibold").removeClass("bg-myblue-0");
        });

        $("#add-domicile-popup").hide();

        $("#add-domicile-button").click(function(e){
            e.preventDefault();
            $("#add-domicile-popup").show();
        });

        $(".cancel-popup-button").click(function(e){
            e.preventDefault();
            $(".popup-container").hide();
        })

        function getCitiesAjax(provinceId){
            let token = $('meta[name="csrf-token"]').attr('content')

            $.ajax({
                method: 'GET',
                url: '/getCities',
                data: {
                    provinceId: provinceId,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                if(!response.error){
                    let cities = response.cities
                    $("#cityFilter").empty();
                    $("#cityFilter").append('<option value=0>Choose City</option>');
                    cities.forEach(c => {
                        $("#cityFilter").append([
                            '<option value=', c.id ,' selected>', c.name ,'</option>',
                        ].join(''))
                    });
                }
            })
        }

        $("#provinceFilter").on("change", function(){
            let provinceId = $(this).val();

            if(provinceId != 0){
                getCitiesAjax(provinceId);
            }
            else{
                $("#cityFilter").empty();
                $("#cityFilter").append('<option value=0>Choose City</option>');
            }
        })

        $("#submit-add-domicile").click(function(){
            let provinceId = $("#provinceFilter").val();
            let cityId = $("#cityFilter").val();
            let domicileStartDate = $("#domicileStartDate").val();

            sendAjax("POST", "/domiciles", {
                provinceId: provinceId,
                cityId: cityId,
                domicileStartDate :domicileStartDate,
            })
        })

    });
</script>

@endsection
