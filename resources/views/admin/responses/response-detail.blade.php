@extends("master.layout")
@section("content")
<div class="mb-4 px-10 mt-8">
    <div class="title-container">
        <p class="text-3xl font-bold">Response Detail</p>
        <div class="flex items-center text-mygrey-3">
            <a class="hover:underline" href={{"/responses/" . $response->questionnaire->year}}>Response Management </a>
            <p class="ml-1"> / Response Detail</p>
        </div>
    </div>
</div>

<div class="w-full md:flex justify-start px-10">
    <div class="bg-myblue-2 text-white w-full md:w-1/2 drop-shadow-md rounded-lg py-4 px-6">
        <div class="title">
            <p class="font-bold">Response of {{$response->questionnaire->year}}'s Questionnaire</p>
        </div>
        <div class="flex py-2 w-full text-left">
            <p class="font-semibold text-myblue-0 w-2/5">User</p>
            <a href={{"/participants/" . $response->user->id}} class="ml-4 w-3/5 cursor-pointer hover:underline">{{$response->user->name}}</a>
        </div>
        <div class="flex py-2 w-full text-left">
            <p class="font-semibold text-myblue-0 w-2/5">City Responded</p>
            <p class="ml-4 w-3/5">{{$response->city->name}}</p>
        </div>
        <div class="flex py-2 w-full text-left">
            <p class="font-semibold text-myblue-0 w-2/5">Responded at</p>
            <p class="ml-4 w-3/5">{{$response->created_at}}</p>
        </div>
    </div>
    
    <div class="bg-myblue-1 text-white w-full md:w-1/2 drop-shadow-md rounded-lg py-4 px-6 mt-4 md:mt-0 md:ml-8">
        <div class="title">
            <p class="font-bold">Response's CPI</p>
        </div>
        <div class="flex items-center">
            <p class="font-bold text-3xl">{{round($response->corruption_index, 1)}}</p>
            <p class="ml-3">/ 100</p>
        </div>
    </div>
</div>

<div class="title mt-8 px-10">
    <p class="font-bold text-2xl">Answers</p>
</div>

<div class="mt-4 flex justify-between items-end px-10">
    <div class="flex">
      <input type="search" name="" id="searchAnswer" placeholder="Search Question" class="bg-myblue-0 mr-4 py-2 px-4">
      <select name="" id="dimensionFilterAnswer" class="bg-myblue-2 text-white mr-4 py-2 px-4 w-1/4 appearance-none">
        <option value=0 selected>Any Dimensions</option>
        @foreach (App\Models\Dimension::all() as $dimension_option)
            <option value={{$dimension_option->id}}>{{$dimension_option->name}}</option> 
        @endforeach
      </select>
      <select name="" id="indicatorFilterAnswer" class="bg-myblue-2 text-white mr-4 py-2 px-4 w-1/4 appearance-none">
        <option value=0 selected>Any Indicators</option>
      </select>
    </div>
  </div>

    <div id="answer-container" class="w-full mt-4 rounded-md bg-white py-4 px-10">
        @foreach ($answers as $answer)
            <div class="mb-8">
                <div>
                    <p class="italic text-sm">{{$answer->question->indicator->dimension->name . " - " . $answer->question->indicator->name}}</p>
                    <p class="font-semibold mt-1">{{$answer->question->name}}</p>
                </div>
                <div class="flex justify-between items-center text-center pt-2">
                    <p>{{$answer->question->leftmost_parameter}}</p>
                    @for ($i = 1; $i < 11; $i++)
                        <p class="w-8 h-8 pt-1 rounded-full {{$i == $answer->answer_key ? 'bg-myblue-2 text-white' : 'bg-myblue-0 '}}">{{$i}}</p>
                    @endfor
                    <p>{{$answer->question->rightmost_parameter}}</p>
                </div>
            </div>
        @endforeach
    </div>
<div class="w-full px-10 py-4">
    {{$answers->links()}}
</div>


<script>
        function searchAnswerAjax(){
            let token = $('meta[name="csrf-token"]').attr('content')
            let dimensionId = $("#dimensionFilterAnswer").val();
            let query = $("#searchAnswer").val();
            let indicatorId = $("#indicatorFilterAnswer").val();

            $.ajax({
                method: 'GET',
                url: '/searchAnswer/' + {!! json_encode($response->id) !!},
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
                    $("#answer-container").empty();
                    let answers = response.answers

                    answers.data.forEach(a => {
                        str = ''
                        for(let i = 1; i < 11; i++){
                            if(i == a.answer_key){
                                str += '<p class="w-8 h-8 pt-1 rounded-full bg-myblue-2 text-white">' + i + '</p>'
                            }
                            else{
                                str += '<p class="w-8 h-8 pt-1 rounded-full bg-myblue-0">' + i + '</p>'
                            }
                        }
                        $("#answer-container").append([
                            '<div class="mb-8">',
                            '<div>',
                                '<p class="italic text-sm">' + a.dimension_name + ' - ' + a.indicator_name ,'</p>',
                                '<p class="font-semibold mt-1">' + a.question_name + '</p>',
                            '</div>',
                            '<div class="flex justify-between items-center text-center pt-2">',
                                '<p>' + a.leftmost_parameter + '</p>',
                                str,
                                    '<p>' + a.rightmost_parameter + '</p>',
                            '</div>',
                        '</div>'
                        ].join(''))
                    });
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

                    $("#indicatorFilterAnswer").empty();
                    $("#indicatorFilterAnswer").append('<option value=0>Any Indicator</option>');
                    indicators.forEach(i => {
                        $("#indicatorFilterAnswer").append([
                            '<option value=', i.id ,' selected>', i.name ,'</option>',
                        ].join(''))
                    });
                }
            })
        }

        $("#dimensionFilterAnswer").on("change", function(){
            searchAnswerAjax();

            let dimensionId = $(this).val();

            if(dimensionId != 0){
                getIndicatorsAjax(dimensionId);   
            }
            else{
                $("#indicatorFilterAnswer").empty();
                $("#indicatorFilterAnswer").append('<option value=0>Any Indicator</option>');
            }
        })

        $("#indicatorFilterAnswer").on("change", function(){
            searchAnswerAjax();
        })

        $(document).on('keyup', '#searchAnswer', function(){
            searchAnswerAjax();
        })

</script>

@endsection()