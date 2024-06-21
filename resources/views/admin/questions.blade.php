@extends('master.layout')
@section("content")

<div class="mt-12 px-10 pb-24">
    <div class="title items-center">
      <p class="text-3xl font-bold">All Questions</p>
      <div class="flex items-center text-mygrey-3">
        <a class="hover:underline" href={{"/questionnaire/" . $questionnaire->year}}>Questionnaire {{$questionnaire->year}} </a>
      </div>
    </div>
  
    <div class="mt-4 flex justify-between items-end">
      <div class="flex">
        <input type="search" name="" id="searchQuestion" placeholder="Search Question" class="bg-myblue-0 mr-4 py-2 px-4">
        <select name="" id="dimensionFilterQuestion" class="bg-myblue-1 text-white mr-4 py-2 px-4 w-1/4 appearance-none">
          <option value=0 selected>Any Dimensions</option>
          @foreach (App\Models\Dimension::where("questionnaire_id", "=", $questionnaire->id)->get() as $dimension_option)
              <option value={{$dimension_option->id}}>{{$dimension_option->name}}</option>
          @endforeach
        </select>
        <select name="" id="indicatorFilterQuestion" class="bg-myblue-1 text-white mr-4 py-2 px-4 w-1/4 appearance-none">
          <option value=0 selected>Any Indicators</option>
        </select>
      </div>
    </div>
  
    <div class="questions-container max-h-full overflow-scroll mt-4 scrollbar-none">
      @foreach ($questionnaire->dimensions as $dimension)
        @foreach($dimension->indicators as $indicator)
          @foreach($indicator->questions as $question)
            <div class="bg-white drop-shadow-md rounded-lg py-4 px-6 mt-4 hover:text-myblue-2">
              <div class="flex w-full items-start justify-between ">
                <div>
                  <p class="text-sm">{{$dimension->name}}</p>
                  <p class="text-sm">{{$indicator->name}}</p>
                  <p class="font-semibold">{{$question->name}}</p>
                </div>
                <div class="">
                  <button id={{"question-" . $question->id}} class="question-setting-button">
                    <i class="fa-solid fa-ellipsis "></i>
                  </button>
                </div>
              </div>
  
              <p class="italic text-sm">[{{$question->leftmost_parameter}} - {{$question->rightmost_parameter}}]</p>
            </div>
          @endforeach
        @endforeach
      @endforeach
    </div>
  </div>

<x-popups.question-setting-popup/>
<x-popups.edit-question-popup/>

<script>

    $(".question-setting-button").click(function(e){
      let currentQuestionId = $(this).attr("id").split("-")[1];
      $("#edit-question-popup").attr("questionId", currentQuestionId);
      $("#question-setting-popup").attr("questionId", currentQuestionId);
      $("#question-setting-popup").show();
    })

    function searchQuestionAjax(){
      let token = $('meta[name="csrf-token"]').attr('content')
      let dimensionId = $("#dimensionFilterQuestion").val();
      let query = $("#searchQuestion").val();
      let indicatorId = $("#indicatorFilterQuestion").val();
  
        $.ajax({
            method: 'GET',
            url: '/searchQuestion/' + {!! json_encode($questionnaire->id) !!},
            data: {
                query: query,
                dimensionId: dimensionId,
                indicatorId: indicatorId,
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
                $(".questions-container").empty();
                let questions = response.questions
  
                console.log(response.questions)
                questions.forEach(q => {
                    $(".questions-container").append([
                      '<div class="bg-white drop-shadow-md rounded-lg py-4 px-6 mt-4 hover:text-myblue-2">',
                      '<div class="flex w-full items-start justify-between ">',
                        '<div>',
                            '<p class="text-sm">', q.dimension_name , '</p>',
                            '<p class="text-sm">', q.indicator_name, '</p>',
                            '<p class="font-semibold">', q.name , '</p>',
                        '</div>',
                        '<div class="">',
                          '<button id="question-', q.id  , '" class="question-setting-button">',
                          ' <i class="fa-solid fa-ellipsis "></i>',
                          '</button>',
                        '</div>',
                      '</div>',
                      '<p class="italic text-sm">[', q.leftmost_parameter, '-', q.rightmost_parameter, ']</p>',
                      '</div>',
                    ].join(''))
                });
  
                $(".question-setting-button").click(function(e){
                  let currentQuestionId = $(this).attr("id").split("-")[1];
                  $("#edit-question-popup").attr("questionId", currentQuestionId);
                  $("#question-setting-popup").attr("questionId", currentQuestionId);
                  $("#question-setting-popup").show();
                })
            }
        })
    }
  
    function getIndicatorsAjax(dimensionId){
        let token = $('meta[name="csrf-token"]').attr('content')
  
        $.ajax({
            method: 'GET',
            url: '/getIndicators',
            data: {
                dimensionId: dimensionId,
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
  
                let indicators = response.indicators
  
                $("#indicatorFilterQuestion").empty();
                $("#indicatorFilterQuestion").append('<option value=0>Any Indicator</option>');
                indicators.forEach(i => {
                    $("#indicatorFilterQuestion").append([
                        '<option value=', i.id ,' selected>', i.name ,'</option>',
                    ].join(''))
                });
            }
        })
    }
  
    $("#dimensionFilterQuestion").on("change", function(){
        searchQuestionAjax();
  
        let dimensionId = $(this).val();
  
        if(dimensionId != 0){
            getIndicatorsAjax(dimensionId);
        }
        else{
            $("#indicatorFilterQuestion").empty();
            $("#indicatorFilterQuestion").append('<option value=0>Any Indicator</option>');
        }
    })
  
    $("#indicatorFilterQuestion").on("change", function(){
        searchQuestionAjax();
    })
  
    $(document).on('keyup', '#searchQuestion', function(){
      searchQuestionAjax();
    })
  
  </script>
  
  @endsection()