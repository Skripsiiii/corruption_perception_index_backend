@extends('master.layout')
@section('content')
@php
    ini_set('memory_limit', '256M');
@endphp

{{-- @include('user.questionnaireHeader') --}}

<div class="w-full py-2 mt-10">

    <div id="infinished-container" class="w-full px-10 justify-between mb-8">
        <p class="font-bold text-3xl mb-8">Unfinished Questionnaire</p>
        <div class="w-full">
            @foreach ($unfinished_responses as $response)
            <div class="w-full flex items-center bg-blue-100 mb-8 rounded-md drop-shadow-md py-4 px-6">
                <div class="w-full">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold text-lg">{{$response->year}} - {{$response->name}}</p>
                            <p class="font-bold text-lg"></p>
                        </div>
                        <div class="text-sm">
                            <a href={{"startQuestionnaire/" . $response->year . "/" . $response->city_id}} class="hover:underline">Continue Questionnaire</a>
                        </div>
                    </div>
                    <p class="font-bold">Progress: </p>
                    <div id="progres-bar-container" class="w-full mx-auto h-6 bg-blue-50 rounded-full text-center">
                        <div id="progress-bar" style="{{'width: ' . round(\App\Models\Answer::where("response_id", "=", $response->response_id)->get()->count() * 100 / $response->total_questions) . '%'}}"
                        class="h-full text-sm bg-gradient-to-r from-bgFifth to-bgThird rounded-full px-4 text-white text-center">
                            {{round(\App\Models\Answer::where("response_id", "=", $response->response_id)->get()->count() * 100 / $response->total_questions)}}%
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="finished-container" class="w-full px-10 justify-between mb-8 mt-10">
        <p class="font-bold text-3xl mb-8">Finished Questionnaire</p>
        <div class="w-full">
            @foreach ($finished_responses as $response)
            <div class="w-full flex items-center bg-green-50 mb-8 rounded-md drop-shadow-md py-4 px-6">
                <div class="w-1/10 mr-4">
                    <i class="fa-solid fa-check text-green-700 text-3xl"></i>
                </div>
                <div class="w-9/10">
                    <p class="font-semibold text-lg">{{$response->year}} - {{$response->name}}</p>
                    <p class="italic text-sm">{{$response->finished_at}}</p>
                    <p class="font-semibold">Corruption Index: {{round($response->corruption_index,2)}} / 100</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
    <script>

    </script>
@endsection
