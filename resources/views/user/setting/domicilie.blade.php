@extends("master/layout")
@section("content")

<div class="w-full">
    <div id="tab2" class=" py-6 px-4 bg-white drop-shadow-md rounded-md w-3/5 mx-auto my-12">
        <p class="font-bold text-3xl">Domicile History</p>
        <div class="">
            @foreach (Auth()->user()->domiciles as $domicile)
            <div class="mt-4">
                <p class="text-lg">{{$domicile->city->name}}, {{$domicile->city->province->name}}</p>
                <p class=""><i>Since</i> <b>{{\Carbon\Carbon::parse($domicile->start_date)->format('Y-m-d')}}</b> <i>to</i> <b>{{$domicile->end_date ?? 'Now'}}</b></p>
            </div>

            @endforeach
        </div>
        <div class="mt-4 text-end flex justify-end">
            <div class="mt-4 text-end">
                <div class="rounded-md  bg-bgThird text-white font-bold hover:bg-bgFourth">
                    <button type="submit" id="add-domicile-button" class="px-4 py-2">+ Add Domicile</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div id="add-domicile-popup" class="popup-container fixed inset-0 center z-20 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/3 m-auto mt-20 mx-auto py-4 px-6">
        <p class="text-2xl font-bold text-center">Add New Domicile</p>
        <div class="mt-4">
            <select name="" id="provinceFilter" class="bg-bgSeventh w-full mr-4 py-2 px-4 appearance-none">
                <option value="0">Choose Province</option>
                @foreach (App\Models\Province::all() as $province_option)
                      <option value={{$province_option->id}} {{isset($province) && $province_option->id == $province->id ? "selected" : ""}} >{{$province_option->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="mt-4">
            <select name="" id="cityFilter" class="w-full bg-bgSeventh mr-4 py-2 px-4 appearance-none">
                <option value="0" selected>Choose City</option>
            </select>
        </div>
        <div class="mt-4">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="domicileStartDate" class="w-full bg-bgSeventh mr-4 py-2 px-4" placeholder="Start Date">
        </div>
        <div>
            <x-popups.error-message/>
        </div>
        <div class="justify-center text-center text-white w-full mt-6">
            <div class="mt-4 text-center justify-center flex items-center">
                <button id="submit-add-domicile" class="bg-bgThird hover:bg-bgFourth transition duration-500 ease-in-out rounded-md py-1 px-3 ml-2">Add Domicile</button>
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
        // $(".tab-content").hide();
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

@endsection()
