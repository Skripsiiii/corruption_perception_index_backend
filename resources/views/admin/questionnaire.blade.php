@extends("master.layout")
@section("content")
@php
    $indicator_chosen = null;
    $totalIndicators = 0;
    $totalQuestions = 0;
@endphp
<div class="px-10 pt-8">
    <div class="title-container">
        <p class="text-3xl font-bold">Questionnaire Management</p>
        
    </div>

    <div class="flex mt-2 items-center">
        <p class="font-semibold">Questionnaire Year:</p>
        <select onchange="if (this.value) window.location.href=this.value;" name="" id="" class="bg-myblue-0 py-1 px-2 ml-2 text-sm rounded-md appearance-none">
            @foreach (App\Models\Questionnaire::all() as $year_option)
                <option value={{"/questionnaire/" . $year_option->year}} {{$year_option->year == $questionnaire->year ? 'selected' : ''}}>{{$year_option->year}}</option>
            @endforeach
        </select>
        
    </div>
    <a href={{"/questions/" . $questionnaire->year}} class="text-sm text-myblue-2">View All Questions</a>
</div>

<div class="px-10 mt-4 w-full">
    <div class="content-left-container w-full md:w-2/6 mt-4">
        <div class="bg-myblue-2 text-white py-4 px-6 rounded-md drop-shadow-md">
            <p class="text-lg"><b>Total Dimensions: </b>{{$questionnaire->dimensions->count()}}</p>
            @php
                foreach ($questionnaire->dimensions as $dimension) {
                    $totalIndicators += $dimension->indicators->count();
                    foreach ($dimension->indicators as $indicator) {
                        $totalQuestions += $indicator->questions->count();
                    }
                }
            @endphp
            <p class="text-lg"><b>Total Indicators: </b>{{$totalIndicators}}</p>
            <p class="text-lg"><b>Total Questions: </b>{{$totalQuestions}}</p>
        </div>
        <form action={{"/questionnaire/" . $questionnaire->year ."/dimensions"}} method="POST" class="flex mt-4">
            @csrf
            <input type="text" name="dimension_name" id="" placeholder="Add Dimension" class="py-1 px-2 bg-myblue-0 rounded-md">
            <div class="bg-myblue-2 w-fit ml-4 py-1 px-2  rounded-md">
                <input type="submit" value="+ Dimension" class=" cursor-pointer text-white">
            </div>
        </form>
    </div>
</div>

<div class="flex w-full mt-8 px-10 pb-10">
    <div class="w-full">
        <div class="title">
            <p class="font-bold text-2xl">Dimensions</p>
            <p class="italic text-mygrey-3 text-sm">Click dimension to see indicators</p>
        </div>
        <div class="">
            <div id="dimension-container" class="w-full">
                @foreach ($questionnaire->dimensions as $dimension)
                    <div id={{"dimension-" . $dimension->id}} class="w-full dimension-container accordion-item mb-4 bg-myblue-0 rounded-lg py-4 px-6 mt-4">
                        <div class="accordion-title flex items-start justify-between">
                            <div class="font-semibold cursor-pointer flex items-start w-full mr-10">
                                <p class="text-justify hover:font-bold">{{$dimension->name}}</p>
                                <p class="text-xs py-1 px-2 ml-4 rounded-full bg-myblue-2 text-white w-fit whitespace-nowrap">{{$dimension->indicators->count()}} indicators</p>
                            </div>
                            <div class="flex items-center w-16 justify-between">
                                <button class="add-indicator-button"><i class="fa-solid fa-add hover:text-myblue-2"></i></button>
                                <button class="edit-dimension-button"><i class="fa-solid fa-edit  hover:text-myblue-2"></i></button>
                                <form action={{route('dimensions.destroy', ['dimension' => $dimension->id])}} method="post" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="accordion-content hidden pt-2">
                            @foreach ($dimension->indicators as $indicator)
                                <div class="indicator-container py-2 w-full justify-between cursor-pointer" indicator='{{json_encode($indicator)}}'>
                                    <div class="flex justify-between">
                                        <div class="flex">
                                            <p class="indicator-name cursor-pointer text-justify hover:font-semibold mr-2">{{$indicator->name}}</p>
                                            <p id="question_count" class="text-xs py-1 px-2 ml-4 font-semibold rounded-full text-black bg-white whitespace-nowrap w-fit">{{$indicator->questions->count()}} questions</p>
                                        </div>
                                        <div class="flex items-center w-16 justify-between">
                                            <button class="add-question-button"><i class="fa-solid fa-add hover:text-myblue-2"></i></button>
                                            <button class="edit-indicator-button"><i class="fa-solid fa-edit hover:text-myblue-2"></i><button>
                                            <form action={{route('indicators.destroy', ['indicator' => $indicator->id])}}method="post" class="indicator-delete-form delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div id={{"questions_container-" . $indicator->id}} class="questions_container w-full">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if ($questionnaire->dimensions->count() <= 0)
                    <p class="w-full py-2 pt-20 px-4 align-middle text-center">There's no dimension in this questionnaire</p>
                @endif
            </div>
            
        </div>
    </div>
</div>

{{-- <div id="indicator_chosen" class="w-full my-4 hidden px-10 pb-24 ">
    <div class="title">
        <p class="font-bold text-2xl">Indicator</p>
    </div>
    <div class="bg-white py-4 mt-4">
        <div class="flex items-center justify-between w-full">
            <div class="font-semibold cursor-pointer flex items-center">
                <p id="indicator_name" class="font-bold text-xl w-3/4"></p>
                <p id="question_count" class="text-xs py-1 px-2 ml-4 rounded-full bg-myyellow-0 text-myyellow-2 w-fit"></p>
            </div>
            <div class="flex items-center w-16 justify-between">
                <button id="add-question-button"><i class="fa-solid fa-add hover:text-myblue-2"></i></button>
                <button id="edit-indicator-button"><i class="fa-solid fa-edit hover:text-myblue-2"></i><button>
                <form id="indicator-delete-form" method="post" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i></button>
                </form>
            </div>
        </div>
        <div id="questions_container">
        </div>
    </div>
</div> --}}

<div id="add-indicator-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6">
      <p class="text-2xl font-bold text-center">Add New Indicator</p>
      <div class="mt-4">
        <input type="text" name="indicator_name" id="new-indicator-name" class="w-full py-2 px-4 bg-mygrey-0" placeholder="Indicator Name">
      </div>
      <div>
        <x-popups.error-message/>
      </div>
      <div class="justify-center flex items-center text-white w-full mt-6">
        <button class="cancel-popup-button bg-mygrey-2 rounded-md py-1 px-3">Cancel</button>
        <button id="submit-add-indicator" class="bg-myblue-2 rounded-md py-1 px-3 ml-4">Submit</button>
      </div>
    </div>
</div>

<div id="add-question-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6">
      <p class="text-2xl font-bold text-center">Add New Question</p>
      <div class="mt-4">
        <input type="text" name="question_name" id="new-question-name" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Question Name">
        <input type="text" name="leftmost_parameter" id="new-question-leftmost" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Leftmost Parameter">
        <input type="text" name="rightmost_parameter" id="new-question-rightmost" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Rightmost Parameter">
      </div>
      <div>
        <x-popups.error-message/>
      </div>
      <div class="justify-center flex items-center text-white w-full mt-6">
        <button class="cancel-popup-button bg-mygrey-2 rounded-md py-1 px-3">Cancel</button>
        <button id="submit-add-question" class="bg-myblue-2 rounded-md py-1 px-3 ml-4">Submit</button>
      </div>
    </div>
</div>

<div id="edit-dimension-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6">
      <p class="text-2xl font-bold text-center">Edit Dimension Name</p>
      <div class="mt-4">
        <input type="text" name="dimension_name" id="new-dimension-name" class="w-full py-2 px-4 bg-mygrey-0" placeholder="Dimension Name">
      </div>
      <div>
        <x-popups.error-message/>
      </div>
      <div class="justify-center flex items-center text-white w-full mt-6">
        <button class="cancel-popup-button bg-mygrey-2 rounded-md py-1 px-3">Cancel</button>
        <button id="submit-edit-dimension" class="bg-myblue-2 rounded-md py-1 px-3 ml-4">Submit</button>
      </div>
    </div>
</div>

<div id="edit-indicator-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6">
      <p class="text-2xl font-bold text-center">Edit Indicator Name</p>
      <div class="mt-4">
        <input type="text" name="indicator_name" id="update-indicator-name" class="w-full py-2 px-4 bg-mygrey-0" placeholder="Indicator Name">
      </div>
      <div>
        <x-popups.error-message/>
      </div>
      <div class="justify-center flex items-center text-white w-full mt-6">
        <button class="cancel-popup-button bg-mygrey-2 rounded-md py-1 px-3">Cancel</button>
        <button id="submit-edit-indicator" class="bg-myblue-2 rounded-md py-1 px-3 ml-4">Submit</button>
      </div>
    </div>
</div>

<x-popups.question-setting-popup id="question-setting-popup"/>
<x-popups.edit-question-popup id="edit-question-popup"/>

<script>
    $(document).ready(()=>{

        $("#add-indicator-popup").hide();
        $("#edit-dimension-popup").hide();
        $("#add-question-popup").hide();
        $("#edit-indicator-popup").hide();
        $("#edit-question-popup").hide();
        $("#question-setting-popup").hide();

        let currentDimensionId = 0;
        let currentIndicatorId = 0;

        $(".add-indicator-button").click(function(e){
            e.preventDefault();
            $("#add-indicator-popup").show();
            currentDimensionId =  $(this).closest(".dimension-container").attr("id").split("-")[1];
        });

        $(".add-question-button").click(function(e){
            e.preventDefault();
            $("#add-question-popup").show();
        });

        $(".edit-dimension-button").click(function(e){
            e.preventDefault();
            $("#edit-dimension-popup").show();
            currentDimensionId =  $(this).closest(".dimension-container").attr("id").split("-")[1];
        });

        $(".edit-indicator-button").click(function(e){
            e.preventDefault();
            $("#edit-indicator-popup").show();
        });

        $(".cancel-popup-button").click(function(){
            currentDimensionId = 0;
            $(this).closest('.popup-container').hide();
            $(".error-message").text("");
        })

        $("#submit-add-indicator").click(function(){
            let indicatorName = $("#new-indicator-name").val();
            sendAjax("POST", "/indicators", {
                indicatorName: indicatorName,
                dimensionId: currentDimensionId
            })
        })

        $("#submit-add-question").click(function(){
            let questionName = $("#new-question-name").val();
            let leftmostParameter = $("#new-question-leftmost").val();
            let rightmostParameter = $("#new-question-rightmost").val();

            sendAjax("POST", "/questions", {
                questionName: questionName,
                leftmostParameter: leftmostParameter,
                rightmostParameter :rightmostParameter,
                indicatorId: currentIndicatorId
            })
        })

        $("#submit-edit-dimension").click(function(){
            let newDimensionName = $("#new-dimension-name").val();

            sendAjax("PUT", "/dimensions/" + currentDimensionId, {
                newDimensionName: newDimensionName
            })
        })

        $("#submit-edit-indicator").click(function(){

            let newIndicatorName = $("#update-indicator-name").val();

            sendAjax("PUT", "/indicators/" + currentIndicatorId, {
                indicatorName: newIndicatorName
            })
        })



        $(".indicator-container").click(function(e){
            let clicked = event.target;

            if(currentIndicatorId == JSON.parse($(this).attr("indicator")).id){
                $('#questions_container-' + currentIndicatorId).slideToggle(200).empty();

                // $(this).next('.accordion-content').slideToggle(200).toggleClass("hidden");

                currentIndicatorId = 0;
                return;
            }

            currentIndicatorId = JSON.parse($(this).attr("indicator")).id;
            let token = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                method: "POST",
                url: "/updateIndicatorChosen",
                data: {indicator_id : currentIndicatorId},
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response) => {
                let questions = response.questions

                $('#indicator_chosen').removeClass("hidden");
                $('#indicator_name').text(response.indicator_chosen.name);
                $('#question_count').text(questions.length + " questions");

                // $('html, body').animate({
                //     scrollTop: $('#indicator_name').offset().top - 100
                // }, 300);

                $('.questions_container').slideToggle(200).empty();

                let i = 0;
                questions.forEach((q) => {
                    $('#questions_container-' + currentIndicatorId).append([
                        '<div class="mt-3 flex items-center justify-between bg-white px-4 py-1 rounded-md text-black">',
                            '<div class="w-4/5">',
                                '<p class="font-semibold">', ++i, ". " , q.name, '</p>',
                                '<p class="text-sm italic">[', q.leftmost_parameter,
                                ' - ', q.rightmost_parameter,
                                ']</p>',
                            '</div>',
                            '<button id="question-', q.id ,'" class="question-setting-button"><i class="fa-solid fa-ellipsis"></i></button>',
                        '</div>'
                    ].join('')).slideDown(200)
                });

                $("#indicator-delete-form").attr("action", "/indicators/" + currentIndicatorId);

                $(".question-setting-button").click(function(e){
                    let currentQuestionId = $(this).attr("id").split("-")[1];
                    $("#edit-question-popup").attr("questionId", currentQuestionId);
                    $("#question-setting-popup").attr("questionId", currentQuestionId);
                    $("#question-setting-popup").show();
                })
            });
        });


    });



</script>

@endsection()
