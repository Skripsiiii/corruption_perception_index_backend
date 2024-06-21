@extends('master.layout')
@section("content")
    <div class="bg-myblue-0 drop-shadow-md rounded-lg py-4 px-6 mt-8 mx-20">
        <p class="font-bold text-center text-2xl">Score Statistics</p>
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
    
    
        <div></div>

    </div>
    <script>
       
    </script>
@endsection

