@extends("master.layout")
@section("content")
<div class="mb-4 px-10 pt-8">
    <div class="title-container">
        <p class="text-3xl font-bold">Responses Management</p>
    </div>
    <div class="flex mt-2 items-center">
        <p class="font-semibold">Questionnaire Year:</p>
        <select onchange="if (this.value) window.location.href=this.value;" name="" id="" class="bg-myblue-0 py-1 px-2 ml-2 text-sm rounded-md appearance-none">
            @foreach (App\Models\Questionnaire::all() as $year_option)
                <option value={{"/responses/" . $year_option->year}} {{$year_option->year == $questionnaire->year ? 'selected' : ''}}>{{$year_option->year}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="w-full md:flex justify-between px-10">
    <div class="w-full md:w-2/6">
        <div class=" bg-myblue-2 drop-shadow-md rounded-lg py-4 px-6">
            <p class="font-bold text-2xl text-white">CPI Score in Total</p>
            <div class="items-center mt-2 text-white">
                @if ($questionnaire->responses->count() == 0)
                    <p class="text-center">There's no Response</p>
                @else                    
                    <p class="text-white">Calculated from {{$questionnaire->responses->count()}} responses: </p>
                    <div class="flex items-center text-white">
                        <p class="font-bold text-2xl ml-2">{{$cpi_score}}</p>
                        <p class="ml-3">/ 100</p>
                    </div>

                @endif
            </div>
        </div>
        <div class=" bg-myblue-1 drop-shadow-md rounded-lg py-4 px-6 mt-8">
            <p class="font-bold text-2xl text-white">CPI Score by Dimension</p>
            <form action="" method="get" class="mb-0 mt-2">
                <select name="" id="dimensionFilterCPI" class="bg-myblue-0 mr-4 py-2 px-4 appearance-none min-w-full max-w-full">
                    <option value=0 selected>Choose a Dimension</option> 
                    @foreach ($questionnaire->dimensions as $dimension_option)
                            <option value={{$dimension_option->id}}>{{$dimension_option->name}}</option> 
                    @endforeach
                </select>
            </form>
            <div class="flex items-center mt-2 text-white" id="dimension-score-container">

            </div>
        </div>
        <div class=" bg-myblue-1 drop-shadow-md rounded-lg py-4 px-6 mt-8">
            <p class="font-bold text-2xl text-white">CPI Score by Province</p>
            <form action="" method="get" class="mb-0 mt-2">
                <select name="" id="provinceFilterCPI" class="bg-myblue-0 mr-4 py-2 px-4 appearance-none min-w-full max-w-full">
                    <option value=0 selected>Choose a Province</option> 
                    @foreach (App\Models\Province::all() as $province_option)
                            <option value={{$province_option->id}}>{{$province_option->name}}</option> 
                    @endforeach
                </select>
            </form>
            <div class="flex items-center mt-2 text-white" id="province-score-container">

            </div>
        </div>
    </div>

    <div class="w-full md:w-4/6 bg-white drop-shadow-md rounded-lg py-4 px-6 mt-8 md:mt-0 md:ml-8">
        <p class="font-bold text-2xl">CPI Score Chart</p>
        <div class="flex items-center">
            <canvas id="myChart-dimension" style="max-height: 400px;"></canvas>
        </div>
    </div>
</div>

<div class=" bg-white rounded-lg mt-8 py-4 px-16">
    <div class="title flex items-center justify-between">
        <p class="font-bold text-2xl">Responses</p>
    </div>
    <div class="md:flex mt-4">
        <input type="search" name="" id="searchResponse" placeholder="Search Participant" class="bg-mygrey-0 mr-4 py-2 px-4">
        <form action="" method="get" class="mb-0">
            <select name="" id="provinceFilterResponse" class="mt-4 md:mt-0 bg-myblue-0 mr-4 py-2 px-4 appearance-none">
                <option value=0 selected>Any Province</option> 
                @foreach (App\Models\Province::all() as $province_option)
                        <option value={{$province_option->id}} {{isset($province) && $province_option->id == $province->id ? "selected" : ""}} >{{$province_option->name}}</option> 
                @endforeach
            </select>
        </form>
        <form action="" method="get" class="mb-0 mt-4 md:mt-0">
            <select name="" id="cityFilterResponse" class="bg-myblue-0 mr-4 py-2 px-4 appearance-none">
                <option value=0 selected>Any City</option>
            </select>
        </form>
    </div>
    <div class="mt-4">
        <table class="w-full text-left">
            <thead class="bg-myblue-2 text-white">
            <th class="py-2 px-4 border-collapse">User</th>
            <th class="py-2 px-4 border-collapse">Province Category</th>
            <th class="py-2 px-4 border-collapse">City Responded</th>
            <th class="py-2 px-4 border-collapse">Responded At</th>
            <th class="py-2 px-4 border-collapse">CPI</th>
            <th class="py-2 px-4 border-collapse">Action</th>
            </thead>
            <tbody id="response-container">
                @foreach ($questionnaire->responses()->where("corruption_index", "!=", null)->paginate(10) as $response)
                    <tr class="border-b-2 border-myblue-0">
                    <td class="py-2 pl-4">{{$response->user->name}}</td>
                    <td class="py-2 pl-4">{{$response->city->province->name}}</td>
                    <td class="py-2 pl-4">{{$response->city->name}}</td>
                    <td class="py-2 pl-4">{{$response->created_at}}</td>
                    <td class="py-2 pl-4">{{round($response->corruption_index,1)}}/100</td>
                    <td class="py-2 pr-8 flex items-center justify-between">
                        <a href='{{"/responses/" . $questionnaire->year . "/". $response->id}}' class="py-2 pl-4">
                            <i class="fa-solid fa-eye text-center text-mygrey-3 hover:text-myblue-2"></i>
                        </a>
                        <form action={{"/responses/" . $response->id}} method="post" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i></button>
                        </form>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{$questionnaire->responses()->paginate(5)->links()}}
        </div>
    </div>
</div>


<script>

    function searchResponseAjax(){
        let token = $('meta[name="csrf-token"]').attr('content')
        let provinceId = $("#provinceFilterResponse").val();
        let query = $("#searchResponse").val();
        let cityId = $("#cityFilterResponse").val();

        $.ajax({
            method: 'GET',
            url: '/searchResponse/' + {!! json_encode($questionnaire->year) !!},
            data: {
                query: query,
                provinceId: provinceId,
                cityId: cityId,
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
                $("#response-container").empty();
                let responses = response.responses

                responses.data.forEach(r => {
                    $("#response-container").append([
                    '<tr class="border-b-2 border-myblue-0">',
                    '<td class="py-2 pl-4">', r.participant_name ,'</td>',
                    '<td class="py-2 pl-4">', r.province_name ,'</td>',
                    '<td class="py-2 pl-4">', r.city_name ,'</td>',
                    '<td class="py-2 pl-4">', r.created_at ,'</td>',
                    '<td class="py-2 pl-4">', r.corruption_index.toFixed(1) ,'/100</td>',
                    '<td class="py-2 pr-8 flex items-center justify-between">',
                        '<a href="/responses/response/', r.id,'" class="py-2 pl-4">',
                            '<i class="fa-solid fa-eye text-center text-mygrey-3 hover:text-myblue-2"></i>',
                        '</a>',
                        '<form action="/responses/', r.id, 'method ="post" class="delete-form">',
                            '@csrf',
                            '@method("DELETE")',
                            '<button type="submit"><i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i></button>',
                        '</form>',
                    '</td>',
                    '</tr>'].join(''))
                });
            }
        })
    }
    
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
                $("#cityFilterResponse").empty();
                $("#cityFilterResponse").append('<option value=0>Any City</option>');
                cities.forEach(c => {
                    $("#cityFilterResponse").append([
                        '<option value=', c.id ,'selected>', c.name ,'</option>',
                    ].join(''))
                });
            }
        })
    }

    $("#provinceFilterResponse").on("change", function(){
        searchResponseAjax();

        let provinceId = $(this).val();

        if(provinceId != 0){
            getCitiesAjax(provinceId);   
        }
        else{
            $("#cityFilterResponse").empty();
            $("#cityFilterResponse").append('<option value=0>Any City</option>');
        }
    })

    $("#cityFilterResponse").on("change", function(){
        searchResponseAjax();
    })

    $(document).on('keyup', '#searchResponse', function(){
        searchResponseAjax();
    })

    let dimensionGroup = {!! json_encode($dimensionGroup) !!};
    createChart("radar", "myChart-dimension", Object.keys(dimensionGroup), Object.values(dimensionGroup));

    function searchDimensionResultAjax(){
        let token = $('meta[name="csrf-token"]').attr('content')
        let dimensionId = $("#dimensionFilterCPI").val();

        $.ajax({
            method: 'GET',
            url: '/calculateDimensionResult/' + {!! json_encode($questionnaire->id) !!},
            data: {
                dimensionId: dimensionId
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
                $("#dimension-score-container").empty();
                let dimensionCpi = response.dimension_cpi

                if(dimensionCpi == 0){
                    return;
                }
                else if(dimensionCpi == -1){
                    $("#dimension-score-container").append([
                        '<p class="mt-2 text-center"> There\'s no Response</p>',
                    ].join(''))
                }
                else{
                    $("#dimension-score-container").append([
                        '<p>Calculated from ', {!! json_encode($questionnaire->responses->count()) !!},' responses: </p>',
                        '<p class="font-bold text-2xl ml-2">',dimensionCpi.toFixed(1) * 10,'</p>',
                        '<p class="ml-3">/ 100</p>',
                    ].join(''))
                }
            }
        })
    }

    $("#dimensionFilterCPI").on("change", function(){
        searchDimensionResultAjax();
    })

    function searchProvinceResultAjax(){
        let token = $('meta[name="csrf-token"]').attr('content')
        let provinceId = $("#provinceFilterCPI").val();

        $.ajax({
            method: 'GET',
            url: '/calculateProvinceResult/' + {!! json_encode($questionnaire->id) !!},
            data: {
                provinceId: provinceId
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
                $("#province-score-container").empty();
                let provinceCpi = response.province_cpi

                if(provinceCpi == 0){
                    return;
                }
                else if(provinceCpi == -1){
                    $("#province-score-container").append([
                        '<p class="mt-2 text-center"> There\'s no response for this province </p>',
                    ].join(''))
                }
                else{
                    $("#province-score-container").append([
                        '<p>Calculated from ', response.num_results, ' responses:</p>',
                        '<p class="font-bold text-2xl ml-2">',provinceCpi.toFixed(1),'</p>',
                        '<p class="ml-3">/ 100</p>',
                    ].join(''))
                }
            }
        })
    }

    $("#provinceFilterCPI").on("change", function(){
        searchProvinceResultAjax();
    })
 
 </script>

@endsection()