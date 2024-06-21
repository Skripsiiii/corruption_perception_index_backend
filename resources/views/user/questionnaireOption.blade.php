@extends('master.layout')
@section('content')
@php
    ini_set('memory_limit', '256M');
@endphp

@include('user.questionnaireHeader')

<div class="w-full py-2 mt-2">
    @if (\App\Models\Domicile::where("user_id", "=", "" . Auth::user()->id . "")->get()->count() == 0)
        <form id="domicile-form" action="" style="" class="w-3/4 bg-white rounded-md drop-shadow-md py-4 px-6 mx-auto">
            <p class="font-bold text-center text-3xl">Incomplete Profile</p>
            <p class="font-bold text-center mt-4 text-2xl">{{"Your Profile is not complete!"}}</p>
            <div class="text-center">
                <p>
                    <br>
                    Corruption Perception Index is calculated based on your living region.
                    <br>
                    We need your domicile data before you continue further. Please complete your profile.
                </p>
                <div class="flex justify-center mt-4">
                    <div id="" class="flex justify-center w-fit text-center bg-bgThird mr-2 my-6 rounded-3xl  text-white text-2xl">
                        <a href="/settings/domicilie" class="px-8 py-2">Complete My Domicile</a>
                    </div>
                </div>
            </div>
        </form>
    @else
    <p class="hidden" id="unfinished-count">{{$responses->count()}}</p>

        <form id="consent-form" action="" style="" class="w-3/4 bg-white rounded-md drop-shadow-md py-4 px-6 mx-auto">
            <p class="font-bold text-center text-3xl">Participant Consent</p>
            <p class="font-bold text-center mt-4 text-2xl">{{"Before We Get Started"}}</p>
            <div class="text-center">
                <p>
                    <br>
                    Before you fill this questionnaire, know that the data of your response will be furtherly used for <b>Corruption Perceptions Index Calculation</b>. Your response might be used for further analysis related to Corruption Perceptions Index. We won’t use your response outside the scope of our Corruption Perception Study.
                    <br><br>
                    You can response to the questions multiple times, but you can only <b>response once for a city in the same year</b>. Only cities that you have ever lived in can be chosen. For example, if you have lived in Jakarta and Bali for 2023, you can response to the questions for Jakarta and Bali 2023’s Questionnaire. You can’t response for Lampung 2023’s Questionnaire or Jakarta 2022’s Questionnaire.
                    <br><br>
                    All question items must be filled, and your response <b>can’t be changed</b> after submission.
                </p>
                <div class="flex justify-center mt-4">
                    <div id="" class="flex justify-center w-fit text-center bg-bgThird mr-2 my-6 rounded-3xl  text-white text-2xl">
                        <button id="agree-btn" class="px-8 py-2" onclick="agreeConsent()" type="button">I Agree</button>
                    </div>
                </div>
            </div>
        </form>

        <form id="year-form" action="" style="" class="w-3/4 hidden bg-white rounded-md drop-shadow-md py-4 px-6 mx-auto">
            <p class="font-bold text-center text-3xl">Choose Questionnaire to Complete</p>
            <div class="my-8 pb-8 w-full">
                <p class="font-bold w-full text-center text-xl mb-4">Choose Year</p>
                <div id="" class="flex justify-center w-full mx-auto items-center">
                    <select onchange="getDimension()" name="" id="yearSelect" class="ml-3 appearance-none bg-mygrey-1 rounded-md px-2 py-1">
                        @foreach (\App\Models\Questionnaire::all() as $questionnaire)
                            <option value={{$questionnaire->year}}>{{$questionnaire->year}}</option>                        
                        @endforeach
                    </select>
                </div>
                <p class="font-bold w-full text-center text-xl mt-8 mb-4">Choose Region</p>
                <div id="" class="flex justify-center w-full mx-auto items-center">
                    <select name="" id="dimensionOption" class="ml-3 appearance-none text-center bg-mygrey-1 rounded-md px-2 py-1">
                        
                    </select>
                </div>
            </div>
            <div class="flex justify-center">
                <div id="regionSelect" class="flex justify-center w-fit text-center bg-bgThird mr-2 mb-6 rounded-3xl  text-white text-2xl">
                    <button id="start-btn" class="px-8 py-2" onclick="startQuestionnaire()" type="button">Start Questionnaire</button>
                </div>
            </div>
        </form>
    @endif

    
    
</div>
    <script>

        $(document).ready(function(){
            // if(parseInt($("#unfinished-count").text()) > 0){
            //     // $("#consent-form").addClass("hidden")
            // }
            // else{
            //     $("#unfinished-container").addClass("hidden")
            //     $("#consent-form").removeClass("hidden")
            // }
        })

        function showConsent(){
            $("#unfinished-container").addClass("hidden")
            $("#consent-form").removeClass("hidden")
        }

        function agreeConsent(){
            $("#consent-form").addClass("hidden");
            $("#year-form").removeClass("hidden");
        }

        function getDimension(){
            let token = $('meta[name="csrf-token"]').attr('content')

            let year = parseInt($('#yearSelect').val())

            $.ajax({
                method: "get",
                url: "/getDomicileByYear/" + year ,
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                let domicile = response.domicile

                $("#dimensionOption").empty()

                domicile.forEach(d => {    
                    $("#dimensionOption").append([
                        '<option class="text-center" value=', d.city_id, '>', d.city_name,'</option>'
                    ].join(''))
                })

            })
        }

        function startQuestionnaire(){

            let token = $('meta[name="csrf-token"]').attr('content')

            let year = parseInt($('#yearSelect').val())

            let city = parseInt($('#dimensionOption').val())
            if(isNaN(year) || year == undefined){
                alert("Choose year!")
                return
            }

            if(isNaN(city) || city == "" || city == undefined){
                alert("Choose city!")
                return
            }

            $.ajax({
                method: "POST",
                url: "/checkQuestionnaireArea",
                data: {
                    year: year,
                    city: city,
                },
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response) => {
                if(response.error){
                    responded = true;

                    popupFail = {
                        text: JSON.stringify(response.error, null, 2).replace(/[[\]{}"']+/g,''),
                        html: '<p>' + JSON.stringify(response.error, null, 2).replace(/[[\]{}"']+/g,'') + '</p><br>' + '<a class="hover:underline text-bgThird" href="/unfinished_questionnaire">Unfinished Questionnaire</a>.',
                        icon: 'warning',
                        iconColor: '#4EB3D3',
                        showCancelButton: false,
                        confirmButtonColor: '#CCCCCC',
                    }

                    Swal.fire(popupFail);
                    $(".error-message").text(JSON.stringify(response.error, null, 2).replace(/[[\]{}"']+/g,''));
                }
                else{
                    $.ajax({
                        method: "POST",
                        url: "/checkQuestionnaire",
                        data: {
                            year: year,
                            city: city
                        },
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    }).done((response)=>{
                        console.log(response);
                        if(!response.error){
                            window.location.href = "/startQuestionnaire/ " + year + "/" + city
                        }
                    })
                }
            });

            
        }

    </script>
@endsection
