@extends('master.layout')
@section('content')
<div class="w-full">
    <div id="home-banner-container bg-white">
        <div class="flex pt-4 w-[80%] items-center justify-center h-full flex-col-reverse md:flex-row gap-4 md:gap-2 my-12 mx-auto bg-bgThird transition-color hover:scale-110 transition duration-300 ease-in-out rounded-xl pb-8 md:pb-0">
            <div class="md:w-3/5 sm:w-full text-center md:text-left md:ml-8">
                <p class="lg:text-5xl text-white md:text-3xl text-xl font-bold">Let's Eradicate Corruption</p>
                <p class="lg:text-2xl text-white md:text-lg my-4 mr-2">Your participation filling the questionnaire of corruption perspective is a precious contribution for corruption eradication in Indonesia.</p>
                @auth
                <div>
                    <a href="/questionnaire" class="cursor-pointer animate-pulse bg-white rounded-md py-2 px-4 mt-8 text-black lg:text-lg md:text-base">Fill Questionnaire Now</a>
                </div>

                @endauth
                @guest
                    <a href="/login" class="cursor-pointer animate-pulse bg-white rounded-md py-2 px-4 mt-8 text-black lg:text-lg md:text-base">Participate Now</a>
                    
                @endguest

            </div>
            <div class="md:w-2/5 sm:w-full flex justify-center md:mr-8">
                <img class="lg:w-full md:w-full w-1/2" src="{{asset("images/corruption-no.png")}}" alt="">
            </div>
        </div>

        <div class="md:flex flex-row w-[80%] justify-between items-center mx-auto my-8">

            <div class=" pt-4 w-full md:w-[60%] h-full flex-col-reverse md:flex-row gap-4 md:gap-2 mr-4 bg-bgBluish rounded-xl pb-8 md:pb-0">
                <p class="lg:text-3xl md:text-2xl text-xl font-bold ml-8">What is CPI?</p>
                <div class="flex items-center justify-center ">
                    <div class="w-2/5 ml-8 mr-8 0">
                        <img class="w-full lg:w-3/4" src="{{asset("images/Pie_chart_1.png")}}" alt="">
                    </div>
                    <div class="md:w-3/5 sm:w-full text-center md:text-justify">
                        <p class="lg:text-lg md:text-md my-4 mr-8">Corruption Perception Index, abbreviated as CPI, is an index of corruption on regional basis.
                        <br>
                        <br>
                        CPI is represented on a scale of 0-100, where 0 indicates a region is highly corrupt, and 100 is very clean.</p>
                    </div>
                </div>
            </div>

            <div class="flex-row pt-4 w-full md:w-[40%] items-center justify-center h-full gap-4 md:gap-2 md:ml-4 mt-8 md:mt-0 bg-bgGreenish rounded-xl pb-6">
                <p class="lg:text-3xl md:text-2xl text-xl font-bold text-center mb-8">Check CPI Score</p>
                <div class="items-center justify-center ">
                    <div class="w-2/3 mx-auto flex justify-center">
                        <img class="w-2/3" src="{{asset("images/Planet_Earth_1.png")}}" alt="">
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <a href="/map" class="cursor-pointer bg-myblue-2 rounded-md py-1 px-4 mx-auto mt-6 text-white lg:text-lg md:text-base">View Map</a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
