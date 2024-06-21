@extends("master/layout")
@section("content")

<div class="w-full py-16 mt-12 flex justify-center items-center">
    <div class="w-2/3 rounded-md p-4 bg-white drop-shadow-xl">
        <div class="overflow-x-auto ">
            <table class="table table-zebra">
            <thead>
                <tr >
                    <th class="font-bold">Indicator</th>
                    <th>Status</th>
                    <th>CPI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($indicatorCorruptionResults as $indicatorCorruptionResult)
                <tr >
                    <th class="bg-white text-xs w-[40%]">{{ $indicatorCorruptionResult->name }}</th>
                    <td class="bg-white font-semibold w-[40%]"><span class="badge drop-shadow-md">{{ $indicatorCorruptionResult->index_result }} / 100</span></td>
                    <td class="bg-white drop-shadow-sm w-[40%]">

                        @if ($indicatorCorruptionResult->index_result >= 0 && $indicatorCorruptionResult->index_result < 2)
                        <span class="bg-red-500 w-auto px-2 py-1 rounded-md font-semibold drop-shadow-md">Highly Corruption</span>
                        @elseif ($indicatorCorruptionResult->index_result >= 2 && $indicatorCorruptionResult->index_result < 4)
                            <span class="bg-red-200 w-auto px-2 py-1 rounded-md font-semibold drop-shadow-md">Corruption</span>
                        @elseif ($indicatorCorruptionResult->index_result >= 4 && $indicatorCorruptionResult->index_result < 6)
                            <span class="bg-green-200 w-auto px-2 py-1 rounded-md font-semibold drop-shadow-md">Neutral</span>
                        @elseif ($indicatorCorruptionResult->index_result >= 6 && $indicatorCorruptionResult->index_result < 8)
                            <span class="bg-green-400 w-auto px-2 py-1 rounded-md font-semibold drop-shadow-md">Safe</span>
                        @elseif ($indicatorCorruptionResult->index_result >= 8 && $indicatorCorruptionResult->index_result <= 10)
                            <span class="bg-green-600 w-auto px-2 py-1 rounded-md font-semibold drop-shadow-md">Highly Safe</span>
                        @endif
                    </td>
                </tr>
                {{-- <tr class="text-center font-bold bg-white border-b-2 border-gray-300">
                    <td class="text-left w-1/4 py-2 px-2 text-xs" >{{$indicatorCorruptionResult->name}}</td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm">{{$indicatorCorruptionResult->index_result}} / 10</td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm">
                        @if ($indicatorCorruptionResult->index_result >= 0 && $indicatorCorruptionResult->index_result < 20)
                            Highly Corruption
                        @elseif ($indicatorCorruptionResult->index_result >= 20 && $indicatorCorruptionResult->index_result < 40)
                            Corruption
                        @elseif ($indicatorCorruptionResult->index_result >= 40 && $indicatorCorruptionResult->index_result < 60)
                            Neutral
                        @elseif ($indicatorCorruptionResult->index_result >= 60 && $indicatorCorruptionResult->index_result < 80)
                            Safe
                        @elseif ($indicatorCorruptionResult->index_result >= 80 && $indicatorCorruptionResult->index_result <= 100)
                            Highly Safe
                        @endif
                    </td>
                    <td class="text-left w-1/4 py-2 px-2 text-sm ">
                        <a href="">
                            <button class="bg-yellow-300 px-4 py-2 rounded-md">
                                Detail
                            </button>
                        </a>
                    </td>
                </tr> --}}
                @endforeach

            </tbody>
        </table>
    </div>
        {{ $indicatorCorruptionResults->links() }}
    </div>

</div>

@endsection()
