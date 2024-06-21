@extends("master/layout")
@section("content")

<div class="w-full px-10 justify-between mt-10 mb-8">
    <p class="font-bold text-3xl text-center">{{$city->name}} - Dimension Corruption Data</p>
    <div class="text-center w-full flex justify-center mx-auto text-slate-500">
        <a href="/provinceData" class="hover:underline">National Corruption</a>
        <p class="mx-2"> / </p>
        <a href={{"/cityData/" . $city->province->id}} class="hover:underline">{{$city->province->name}}</a>
        <p class="ml-2"> / {{$city->name}} </p>
    </div>
</div>
<div class="w-2/3 mx-auto flex justify-end">
    <a class="rounded-md py-2 px-4 bg-bgThird text-white" href={{"/cityResponse/" . $city->id}}>Export to Excel</a>
</div>
<div class="w-full py-4 pb-10 flex justify-center items-center">
    <div class="w-2/3 p-4 bg-white rounded-md drop-shadow-xl">
        <div class="overflow-x-auto ">
            
                <div>
                    @foreach ($dimensionCorruptionResults as $dimensionCorruptionResult)
                        <div class="my-4">
                            <p>{{$dimensionCorruptionResult->name}}</p>
                            <div class="flex items-center">
                                <div class="w-full h-fit py-0 bg-slate-200 rounded-l-xl rounded-r-xl">
                                    @if ($dimensionCorruptionResult->index_result * 10 >= 0 && $dimensionCorruptionResult->index_result * 10 < 20)
                                    <div class="bg-scale-10 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 10 && $dimensionCorruptionResult->index_result * 10 < 20)
                                        <div class="bg-scale-9 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 20 && $dimensionCorruptionResult->index_result * 10 < 30)
                                        <div class="bg-scale-8 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 30 && $dimensionCorruptionResult->index_result * 10 < 40)
                                        <div class="bg-scale-7 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 40 && $dimensionCorruptionResult->index_result * 10 < 50)
                                        <div class="bg-scale-6 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 50 && $dimensionCorruptionResult->index_result * 10 < 60)
                                        <div class="bg-scale-5 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 60 && $dimensionCorruptionResult->index_result * 10 < 70)
                                        <div class="bg-scale-4 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 70 && $dimensionCorruptionResult->index_result * 10 < 80)
                                        <div class="bg-scale-3 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 80 && $dimensionCorruptionResult->index_result * 10 < 90)
                                        <div class="bg-scale-2 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @elseif ($dimensionCorruptionResult->index_result * 10 >= 90 && $dimensionCorruptionResult->index_result * 10 < 100)
                                        <div class="bg-scale-1 h-6 rounded-l-xl rounded-r-xl text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($dimensionCorruptionResult->index_result * 10,1)}}%;">{{ round($dimensionCorruptionResult->index_result * 10,1) }}/100</div>
                                    @endif
                                </div>
                            <a href="/indicatorCityData/{{ $dimensionCorruptionResult->id }}" class="ml-4">
                                <button class="bg-blue-500 px-4 py-2 rounded-md text-white font-semibold">
                                    Detail
                                </button>
                            </a>
                            </div>
                        </div>
                    @endforeach
                </div>
    </div>
        {{ $dimensionCorruptionResults->links() }}
    </div>

</div>

@endsection()
