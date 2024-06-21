@extends("master/layout")
@section("content")

<div class="w-full px-10 justify-between mt-10 mb-8">
    <p class="font-bold text-3xl text-center">{{$province->name}} - Cities Corruption Data</p>
    <div class="text-center w-full flex justify-center mx-auto text-slate-500">
        <a href="/provinceData" class="hover:underline">National Corruption</a> <p class="ml-2"> / {{$province->name}} </p>
    </div>
</div>
<div class="w-2/3 mx-auto flex justify-between items-center">
    <div class="flex items-center">
        <p class="font-bold text-2xl">{{$province->name}} CPI: </p>
        <p class="font-bold text-2xl ml-2">{{$provincesCorruption}} / 100</p>
    </div>
    <a class="rounded-md py-2 px-4 bg-bgThird text-white" href={{"/cityResponse/" . $province->id}}>Export to Excel</a>
</div>
<div class="w-full py-4 pb-10  flex justify-center items-center">
    
    <div class="w-2/3 p-4 bg-white rounded-md drop-shadow-xl">
        <div class="overflow-x-auto ">
            <table class="table table-zebra">
            <thead>
                <tr >
                    <th class="font-bold">City</th>
                    <th>Status</th>
                    <th colspan="2" class="w-1/3">CPI</th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cityCorruptionResults as $cityCorruptionResult)
                <tr >
                    <th class="bg-white">{{ $cityCorruptionResult->name }}</th>
                    <td class="bg-white">
                        @if ($cityCorruptionResult->index_result >= 0 && $cityCorruptionResult->index_result < 10)
                                <span class="bg-scale-10 text-white w-auto px-2 py-1 rounded-md font-semibold">Highly Corrupt</span>
                            @elseif ($cityCorruptionResult->index_result >= 10 && $cityCorruptionResult->index_result < 20)
                                <span class="bg-scale-9 text-white w-auto px-2 py-1 rounded-md font-semibold">Highly Corrupt</span>
                            @elseif ($cityCorruptionResult->index_result >= 20 && $cityCorruptionResult->index_result < 30)
                                <span class="bg-scale-8 text-white w-auto px-2 py-1 rounded-md font-semibold">Corrupt</span>
                            @elseif ($cityCorruptionResult->index_result >= 30 && $cityCorruptionResult->index_result < 40)
                                <span class="bg-scale-7 text-white w-auto px-2 py-1 rounded-md font-semibold">Corrupt</span>
                            @elseif ($cityCorruptionResult->index_result >= 40 && $cityCorruptionResult->index_result < 50)
                                <span class="bg-scale-6 text-white w-auto px-2 py-1 rounded-md font-semibold">Neutral</span>
                            @elseif ($cityCorruptionResult->index_result >= 50 && $cityCorruptionResult->index_result < 60)
                                <span class="bg-scale-5 text-white w-auto px-2 py-1 rounded-md font-semibold">Neutral</span>
                            @elseif ($cityCorruptionResult->index_result >= 60 && $cityCorruptionResult->index_result < 70)
                                <span class="bg-scale-4 text-white w-auto px-2 py-1 rounded-md font-semibold">Safe</span>
                            @elseif ($cityCorruptionResult->index_result >= 70 && $cityCorruptionResult->index_result < 80)
                                <span class="bg-scale-3 text-white w-auto px-2 py-1 rounded-md font-semibold">Safe</span>
                            @elseif ($cityCorruptionResult->index_result >= 80 && $cityCorruptionResult->index_result < 90)
                                <span class="bg-scale-2 text-white w-auto px-2 py-1 rounded-md font-semibold">Very Safe</span>
                            @elseif ($cityCorruptionResult->index_result >= 90 && $cityCorruptionResult->index_result < 100)
                                <span class="bg-scale-1 text-white w-auto px-2 py-1 rounded-md font-semibold">Very Safe</span>
                            @endif
                    </td>
                    <td colspan="2" class="bg-white">
                        <div class="w-full h-fit py-0 bg-slate-200">
                            @if ($cityCorruptionResult->index_result >= 0 && $cityCorruptionResult->index_result < 10)
                                <div class="bg-scale-10 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 10 && $cityCorruptionResult->index_result < 20)
                                <div class="bg-scale-9 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 20 && $cityCorruptionResult->index_result < 30)
                                <div class="bg-scale-8 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 30 && $cityCorruptionResult->index_result < 40)
                                <div class="bg-scale-7 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 40 && $cityCorruptionResult->index_result < 50)
                                <div class="bg-scale-6 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 50 && $cityCorruptionResult->index_result < 60)
                                <div class="bg-scale-5 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 60 && $cityCorruptionResult->index_result < 70)
                                <div class="bg-scale-4 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 70 && $cityCorruptionResult->index_result < 80)
                                <div class="bg-scale-3 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 80 && $cityCorruptionResult->index_result < 90)
                                <div class="bg-scale-2 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @elseif ($cityCorruptionResult->index_result >= 90 && $cityCorruptionResult->index_result < 100)
                                <div class="bg-scale-1 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($cityCorruptionResult->index_result,1)}}%;">{{ round($cityCorruptionResult->index_result,1) }}/100</div>
                            @endif
                        </div>
                    </td>
                    <td class="bg-white">
                        <a href="/dimensionCityData/{{ $cityCorruptionResult->id }}">
                            <button class="bg-blue-500 px-4 py-2 rounded-md text-white font-semibold">
                                Detail
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        {{ $cityCorruptionResults->links() }}
    </div>

</div>
@endsection()
