@extends('master.layout')
@section('content')
    <div class="w-full px-10 justify-between mt-10">
        <p class="font-bold text-3xl text-center mb-8">Provinces Corruption Data</p>
    </div>
    <div class="w-2/3 mx-auto flex justify-end">
        <a class="rounded-md py-2 px-4 bg-bgThird text-white" href="/provinceResponse">Export to Excel</a>
    </div>
    <div class="w-full py-4 pb-10 flex justify-center items-center">
        <div class="w-2/3 rounded-md p-4 bg-white drop-shadow-xl">
            <div class="overflow-x-auto ">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="font-bold px-2">Province</th>
                            <th class="">Status</th>
                            <th colspan="2" class="w-1/3">CPI</th>
                            <th>Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provincesCorruption as $provinceCorruption)
                            <tr >
                                <th class="bg-white">{{ $provinceCorruption->name }}</th>
                                <td class="bg-white">
                                    @if ($provinceCorruption->index_result >= 0 && $provinceCorruption->index_result < 10)
                                            <span class="bg-scale-10 text-white w-auto px-2 py-1 rounded-md font-semibold">Highly Corrupt</span>
                                        @elseif ($provinceCorruption->index_result >= 10 && $provinceCorruption->index_result < 20)
                                            <span class="bg-scale-9 text-white w-auto px-2 py-1 rounded-md font-semibold">Highly Corrupt</span>
                                        @elseif ($provinceCorruption->index_result >= 20 && $provinceCorruption->index_result < 30)
                                            <span class="bg-scale-8 text-white w-auto px-2 py-1 rounded-md font-semibold">Corrupt</span>
                                        @elseif ($provinceCorruption->index_result >= 30 && $provinceCorruption->index_result < 40)
                                            <span class="bg-scale-7 text-white w-auto px-2 py-1 rounded-md font-semibold">Corrupt</span>
                                        @elseif ($provinceCorruption->index_result >= 40 && $provinceCorruption->index_result < 50)
                                            <span class="bg-scale-6 text-white w-auto px-2 py-1 rounded-md font-semibold">Neutral</span>
                                        @elseif ($provinceCorruption->index_result >= 50 && $provinceCorruption->index_result < 60)
                                            <span class="bg-scale-5 text-white w-auto px-2 py-1 rounded-md font-semibold">Neutral</span>
                                        @elseif ($provinceCorruption->index_result >= 60 && $provinceCorruption->index_result < 70)
                                            <span class="bg-scale-4 text-white w-auto px-2 py-1 rounded-md font-semibold">Safe</span>
                                        @elseif ($provinceCorruption->index_result >= 70 && $provinceCorruption->index_result < 80)
                                            <span class="bg-scale-3 text-white w-auto px-2 py-1 rounded-md font-semibold">Safe</span>
                                        @elseif ($provinceCorruption->index_result >= 80 && $provinceCorruption->index_result < 90)
                                            <span class="bg-scale-2 text-white w-auto px-2 py-1 rounded-md font-semibold">Very Safe</span>
                                        @elseif ($provinceCorruption->index_result >= 90 && $provinceCorruption->index_result < 100)
                                            <span class="bg-scale-1 text-white w-auto px-2 py-1 rounded-md font-semibold">Very Safe</span>
                                        @endif
                                </td>
                                <td colspan="2" class="bg-white">
                                    <div class="w-full h-fit py-0 bg-slate-200">
                                        @if ($provinceCorruption->index_result >= 0 && $provinceCorruption->index_result < 10)
                                            <div class="bg-scale-10 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 10 && $provinceCorruption->index_result < 20)
                                            <div class="bg-scale-9 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 20 && $provinceCorruption->index_result < 30)
                                            <div class="bg-scale-8 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 30 && $provinceCorruption->index_result < 40)
                                            <div class="bg-scale-7 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 40 && $provinceCorruption->index_result < 50)
                                            <div class="bg-scale-6 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 50 && $provinceCorruption->index_result < 60)
                                            <div class="bg-scale-5 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 60 && $provinceCorruption->index_result < 70)
                                            <div class="bg-scale-4 h-6 text-xs leading-none text-center font-bold text-black flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 70 && $provinceCorruption->index_result < 80)
                                            <div class="bg-scale-3 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 80 && $provinceCorruption->index_result < 90)
                                            <div class="bg-scale-2 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @elseif ($provinceCorruption->index_result >= 90 && $provinceCorruption->index_result < 100)
                                            <div class="bg-scale-1 h-6 text-xs leading-none text-center font-bold text-white flex pl-1 items-center" style="width: {{round($provinceCorruption->index_result,1)}}%;">{{ round($provinceCorruption->index_result,1) }}/100</div>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="bg-white">
                                    <a href="/cityData/{{ $provinceCorruption->id }}">
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
            {{-- <table class="w-full whitespace-no-wrap w-full whitespace-no-wrap rounded-md ">
            <thead>
                <tr class="text-center font-bold border-t-2 border-b-2 border-gray-300">
                    <th class="bg-gray-200 text-left w-1/4 py-2 px-2 text-sm">Province</th>
                    <th class="bg-gray-200 text-left w-1/4 py-2 px-2 text-sm">CPI</th>
                    <th class="bg-gray-200 text-left w-1/4 py-2 px-2 text-sm">Status</th>
                    <th class="bg-gray-200 text-left w-1/4 py-2 px-2 text-sm">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provincesCorruption as $provinceCorruption)
                <tr class="text-center font-bold bg-white border-b-2 border-gray-300">
                    <td class="text-left w-1/4 py-2 px-2 text-sm">{{$provinceCorruption->name}}</td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm">{{$provinceCorruption->index_result}}/100</td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm">
                        @if ($provinceCorruption->index_result >= 0 && $provinceCorruption->index_result < 20)
                            Highly Corruption
                        @elseif ($provinceCorruption->index_result >= 20 && $provinceCorruption->index_result < 40)
                            Corruption
                        @elseif ($provinceCorruption->index_result >= 40 && $provinceCorruption->index_result < 60)
                            Neutral
                        @elseif ($provinceCorruption->index_result >= 60 && $provinceCorruption->index_result < 80)
                            Safe
                        @elseif ($provinceCorruption->index_result >= 80 && $provinceCorruption->index_result <= 100)
                            Highly Safe
                        @endif
                    </td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm">
                        <a href="/cityData/{{$provinceCorruption->id}}">
                            <button class="bg-yellow-300 px-4 py-2 rounded-md">
                                Detail
                            </button>
                        </a>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table> --}}

            {{ $provincesCorruption->links() }}
        </div>

    </div>
@endsection()
