@extends('master.layout')
@section("content")
@php
    ini_set('memory_limit', '256M');
    $totalIndicators = 0;
    $totalQuestions = 0;
@endphp
<div class="mb-4 px-10 pt-8">
    <div class="title-container ">
        <p class="text-3xl font-bold">Dashboard</p>
    </div>

    <div class="flex mt-2 items-center">
        <p class="font-semibold">Questionnaire Year:</p>
        <select onchange="if (this.value) window.location.href=this.value;" name="" id="" class="bg-myblue-0 py-1 px-2 ml-2 text-sm rounded-md appearance-none">
          @foreach (App\Models\Questionnaire::all() as $year_option)
              <option class="bg-mygrey-1" value={{"/dashboard/" . $year_option->year}} {{$year_option->year == $questionnaire->year ? 'selected' : ''}}>{{$year_option->year}}</option>
          @endforeach
      </select>
    </div>
</div>

<div class="md:flex px-10">
  <div class="content-left-container w-full md:w-1/2">
    <div class="flex">
        <div class="bg-myblue-2 w-1/2 text-white drop-shadow-md rounded-lg py-4 px-6">
            <div class="title">
                <p class="font-bold">Total Responses</p>
            </div>
            <div class="flex items-center">
                <p class="font-bold text-3xl ">{{$questionnaire->responses->count()}}</p>
                <p class="ml-3">Responses</p>
            </div>
        </div>

        <div class="bg-myblue-1 w-1/2 text-white drop-shadow-md rounded-lg py-4 px-6 ml-8">
            <div class="title">
                <p class="font-bold">Current CPI Score</p>
            </div>

            <div class="flex items-center">
              @if ($questionnaire->responses->count() == 0)
                    <p class="text-center">There's no Response</p>
                @else
                    <p class="font-bold text-3xl ml-2">{{round($questionnaire->responses()->avg('corruption_index'), 1)}}</p>
                    <p class="ml-3">/ 100</p>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-slate-100 drop-shadow-md rounded-lg py-4 px-6 mt-8">
        <div class="title">
          <div class="flex justify-between items-center">
            <p class="font-bold text-center text-2xl">Dimension Statistics</p>
            <a href={{"/statistic"}}><i class="fa-solid fa-eye"></i></a>
          </div>

          <div>
            @foreach ($dimensionGroup as $d => $val)
                <div class="my-4">
                    <p>{{$d}}</p>
                    <div class="w-full h-fit py-0 bg-slate-200 rounded-l-xl rounded-r-xl">
                        @if ($val * 10 >= 0 && $val * 10 < 20)
                            <div class="bg-scale-10 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 10 && $val * 10 < 20)
                            <div class="bg-scale-9 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 20 && $val * 10 < 30)
                            <div class="bg-scale-8 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 30 && $val * 10 < 40)
                            <div class="bg-scale-7 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 40 && $val * 10 < 50)
                            <div class="bg-scale-6 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 50 && $val * 10 < 60)
                            <div class="bg-scale-5 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 60 && $val * 10 < 70)
                            <div class="bg-scale-4 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 70 && $val * 10 < 80)
                            <div class="bg-scale-3 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 80 && $val * 10 < 90)
                            <div class="bg-scale-2 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @elseif ($val * 10 >= 90 && $val * 10 < 100)
                            <div class="bg-scale-1 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($val * 10,1)}}%;">{{ round($val * 10,1) }}/100</div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
      </div>
        {{-- <canvas id="myChart-dimension" style="max-height: 400px;"></canvas> --}}
    </div>
  </div>

  <div class="content-right-container mt-8 md:mt-0 w-full md:w-1/2 md:ml-8">
    <div class="bg-bgFifth text-white drop-shadow-md rounded-lg py-4 px-6">
      <div class="title flex items-center justify-between">
          <p class="font-bold text-2xl">Participant Management</p>
          <a href={{"/participants"}}><i class="fa-solid fa-eye text-white"></i></a>
      </div>
      
      <div mt-4>
        <p class="text-lg"><b>Total Participants: </b>{{\App\Models\User::where("role_id", "=", 3)->get()->count()}}</p>
      </div>
    </div>

    <div class="bg-bgThird text-white drop-shadow-md rounded-lg py-4 px-6 mt-8">
      <div class="title flex items-center justify-between">
          <p class="font-bold text-2xl">Questionnaire Management</p>
          <a href={{"/questionnaire/" . $questionnaire->year}}><i class="fa-solid fa-eye text-white"></i></a>
      </div>
      
      <div mt-4>
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
    </div>

    <div class="bg-slate-100 drop-shadow-md rounded-lg py-4 px-6 mt-8">
      <div class="title flex justify-between items-center">
        <p class="font-bold text-2xl">Responses Management</p>
        <a href={{"/responses/" . $questionnaire->year}}><i class="fa-solid fa-eye "></i></a>
      </div>
      <div>
        <p class="font-bold text-lg">Provinces with Top Reponses: </p>
      </div>
      <div class="overflow-scroll w-full max-h-80 hide-scrollbar flex justify-center">
        <canvas id="myChart-responses" style="" class="w-3/4 "></canvas>
      </div>
    </div>
  </div>
</div>

<div class="absolute bottom-0 rounded-lg right-0 mr-10 mb-4 mt-4 cursor-pointer">
  <form action="">
    <button id="add-questionnaire-button" class="bg-mygrey-1 text-black hover:bg-mygrey-2 rounded-md py-2 px-4">
      + Questionnaire
    </button>
  </form>
</div>

<x-popups.question-setting-popup/>
<x-popups.edit-question-popup/>
<x-popups.create-questionnaire-popup />

<script>

  $(".question-setting-button").click(function(e){
    let currentQuestionId = $(this).attr("id").split("-")[1];
    $("#edit-question-popup").attr("questionId", currentQuestionId);
    $("#question-setting-popup").attr("questionId", currentQuestionId);
    $("#question-setting-popup").show();
  })

  let dimensionGroup = {!! json_encode($dimensionGroup) !!};

  let responses = {!! json_encode($responses) !!};
  if(responses.length == 0){

  }
  else{
    createChart("bar", "myChart-responses", Object.keys(responses), Object.values(responses));
  }


  if(dimensionGroup.length == 0){
    $("#myChart-dimension").parent().append('<p class="text-center">There\'s no score yet</p>')
    $("#myChart-dimension").remove()
  }
  else{
    createChart("radar", "myChart-dimension", Object.keys(dimensionGroup), Object.values(dimensionGroup));
  }

  $("#add-questionnaire-popup").hide();

  $("#add-questionnaire-button").click((e)=>{
    e.preventDefault();
    $("#add-questionnaire-popup").show();
  });

  $("#submit-questionnaire-scratch").click(function(){
    let questionnaireYear = $("#new-questionnaire-year").val();

    sendAjax("POST", "/questionnaires", {
      questionnaireYear: questionnaireYear,
      copy: false
    })
  })

  $("#submit-questionnaire-copy").click(function(){
      let token = $('meta[name="csrf-token"]').attr('content')
      let questionnaireYear = $("#new-questionnaire-year").val();

      sendAjax("POST", "/questionnaires", {
        questionnaireYear: questionnaireYear,
        copy: true
      })
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
                        '<p class="text-sm">', q.dimension_name ,'-', q.indicator_name ,'</p>',
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
