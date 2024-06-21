@extends('master.layout')
@section('content')
@php
    ini_set('memory_limit', '256M');
@endphp

@include('user.questionnaireHeader')

<div class="w-full py-2 mt-2">
    <p class="font-bold w-3/4 mx-auto text-xl">{{\App\Models\Questionnaire::find($questionnaire->id)->year}} - {{\App\Models\City::find($city)->name}}</p>
    <p class="font-bold w-3/4 mx-auto">Your progress: </p>
    <div id="progres-bar-container" class="w-3/4 mx-auto mb-8 h-6 bg-mygrey-1 rounded-full">
        <div id="progress-bar" total_questions={{$total_questions}} answered_questions={{$answered_questions}} class="h-full text-sm bg-gradient-to-r from-bgFifth to-bgThird rounded-full px-4 text-white text-center" style="width: 0%;"></div>
    </div>

    <form id="question-form" action="" style="animation-iteration-count: 1" class="w-3/4 bg-white rounded-md drop-shadow-md py-4 px-6 mx-auto">
        <p class="font-bold text-center text-3xl">{{$dimension->name}}</p>
        <p class="font-bold text-center mt-4 text-2xl">{{$indicator->name}}</p>
        <br>

        @foreach ($questions as $question)
            <div id={{"questionContainer-" . $question->question_number}} class="question-container my-8 pb-8 w-full border-b-2 border-b-slate-100 opacity-40">
                <p class="font-bold w-full text-center text-xl mb-4">{{$question->name}}</p>
                <div id={{"question-" . $question->id}} class="scale-container flex justify-between items-center">
                    <p class="font-bold text-myblue-3">{{$question->leftmost_parameter}}</p>
                    @for ($i = 1; $i < 11; $i++)
                        <div id="" class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">{{$i}}</div>
                    @endfor
                    <p class="font-bold text-myblue-3">{{$question->rightmost_parameter}}</p>
                </div>
            </div>
        @endforeach

        <div class="w-full flex justify-center text-center">
            <div id="prev-question-btn-container" class="w-fit text-center bg-slate-500 mr-2 my-6 rounded-3xl  text-white text-2xl">
                <button id="prev-question-btn" disabled class="px-8 py-2 hidden" onclick="prev_questions()" type="button">Previous</button>
            </div>
            <div id="next-question-btn-container" class="w-fit text-center bg-slate-500 my-6 rounded-3xl  text-white text-2xl">
                <button id="next-question-btn" disabled class="px-12 py-2" onclick="next_questions()" type="button">Next</button>
            </div>
        </div>
        
        <p class="hidden" id="current-questionnaire">{{$questionnaire->id}}</p>
        <p class="hidden" id="current-dimension" dimension_number={{$dimension_number}}>{{$dimension->id}}</p>
        <p class="hidden" id="current-indicator" indicator_number={{$indicator_number}}>{{$indicator->id}}</p>
        <p class="hidden" id="current-question-number">{{$question_number}}</p>
        <p class="hidden" id="current-city">{{$city}}</p>
    </form>
    
</div>
<div id="loading-spin" role="status" class="fixed top-0 left-0 right-0 bottom-0 bg-slate-700 opacity-20 my-0 w-full flex items-center justify-center">
    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-bgFourth" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>
    <span class="sr-only">Loading...</span>
</div>


    <script>
    
        function question_scale(){
            $('.question-scale').click(function(){
                $(this).parent('.scale-container').find('.question-scale').removeClass('active-scale');
                $(this).parent('.scale-container').find('.question-scale').removeClass('bg-bgThird');
                $(this).parent('.scale-container').find('.question-scale').removeClass('text-white');
                $(this).parent('.scale-container').find('.question-scale').addClass('bg-white');
                $(this).addClass('active-scale bg-bgThird text-white');
                $(this).removeClass('bg-white');

                let question_number = parseInt($(this).parent(".scale-container").parent(".question-container").attr('id').substring(18))
                $(this).parent(".question-container").addClass("opacity-40")

                let question_container = $('#questionContainer-' + (question_number+1));

                if(question_number+1 > parseInt($('#current-question-number').text())){
                    
                }
                else{
                    question_container.removeClass("opacity-40")

                    $('html, body').animate({
                        scrollTop: question_container.offset().top - 400
                    }, 500);
                    event.preventDefault();
                }

                let disabled = false

                $('.scale-container').each(function(){
                    if($(this).find('.active-scale').length == 0){
                        disabled = true
                        return
                    }
                })

                

                let answered_questions = parseInt($("#progress-bar").attr("answered_questions"));
                let total_questions = parseInt($("#progress-bar").attr("total_questions"));
                progress = (answered_questions / total_questions * 100).toFixed(0);

                $("#progress-bar").animate({width: progress + "%"});
                $("#progress-bar").text(progress + "%");

                if(progress >= 100){
                    $("#submit-questionnaire-btn").removeAttr('disabled').removeClass("bg-mygrey-2").addClass("bg-gradient-to-r from-myblue-2 to-myblue-3");
                }

                if(!disabled){
                    $("#next-question-btn").removeAttr("disabled")
                    $("#next-question-btn-container").removeClass("bg-slate-500")
                    $("#next-question-btn-container").addClass("bg-bgFourth")

                    if($(".question-container").length + answered_questions == total_questions){
                        $("#next-question-btn").text("Submit")
                        $("#next-question-btn").removeClass("px-12")
                        $("#next-question-btn").addClass("px-8")
                    }
                }
            });
        }

        function refresh_views(questionnaire, city, dimension, dimension_number, indicator, indicator_number, questions, total_questions, answered_questions){
            $("#question-form").empty()
            $("#question-form").append([
                '<p class="font-bold text-center text-3xl">', dimension.name, '</p>',
                '<p class="font-bold text-center mt-4 text-2xl">', indicator.name, '</p>',
                '<br>'
            ].join(''))

            questions.forEach(q => {
                $("#question-form").append([
                    '<div id="questionContainer-', q.question_number, '" class="question-container my-8 pb-8 w-full border-b-2 border-b-slate-100 opacity-40">' ,
                        '<p class="font-bold w-full text-center text-xl mb-4">', q.name, '</p>',
                        '<div id="question-', q.id, '" class="scale-container flex justify-between items-center">',
                            '<p class="font-bold text-myblue-3">', q.leftmost_parameter, '</p>',
                            '<div id="" scale-number=', 1 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 1, '</div>',
                            '<div id="" scale-number=', 2 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 2, '</div>',
                            '<div id="" scale-number=', 3 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 3, '</div>',
                            '<div id="" scale-number=', 4 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 4, '</div>',
                            '<div id="" scale-number=', 5 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 5, '</div>',
                            '<div id="" scale-number=', 6 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 6, '</div>',
                            '<div id="" scale-number=', 7 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 7, '</div>',
                            '<div id="" scale-number=', 8 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 8, '</div>',
                            '<div id="" scale-number=', 9 ,' class="question-scale rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 9, '</div>',
                            '<div id="" scale-number=', 10 ,' class="question-scale  rounded-full cursor-pointer border-2 border-bgThird  hover:bg-bgThird hover:text-white text-center py-2 px-4">', 10, '</div>',
                            '<p class="font-bold text-myblue-3">', q.rightmost_parameter, '</p>',
                        '</div>',
                    '</div>',
                ].join(''))

                if(typeof(q.answer_key) !== "undefined" && q.answer_key != null){
                    $("#questionContainer-" + q.question_number).removeClass("opacity-40");

                    let scale = $("#question-" + q.id).find(".question-scale[scale-number='" + q.answer_key + "']");
                    scale.addClass('active-scale');
                    scale.addClass('bg-bgThird');
                    scale.addClass('text-white');
                    scale.removeClass('bg-white');
                }
            });

            $("#question-form").append([
                '<div class="w-full flex justify-center text-center">',
                    '<div id="prev-question-btn-container" class="w-fit text-center bg-slate-500 mr-2 my-6 rounded-3xl  text-white text-2xl">',
                        '<button id="prev-question-btn" disabled class="px-8 py-2 hidden" onclick="prev_questions()" type="button">Previous</button>',
                    '</div>',
                    '<div id="next-question-btn-container" class="w-fit text-center bg-slate-500 my-6 rounded-3xl  text-white text-2xl">',
                        '<button id="next-question-btn" disabled class="px-12 py-2" onclick="next_questions()" type="button">Next</button>',
                    '</div>',
                '</div>',
                    '<p class="hidden" id="current-questionnaire">', questionnaire.id, '</p>',
                    '<p class="hidden" id="current-dimension" dimension_number=', dimension_number, '>', dimension.id, '</p>',
                    '<p class="hidden" id="current-indicator" indicator_number=', indicator_number, '>', indicator.id, '</p>',
                    '<p class="hidden" id="current-question-number">', questions[questions.length-1].question_number, '</p>',
                    '<p class="hidden" id="current-city">',city,'</p>'
            ].join(''))

            question_scale()

            $(".question-container:first").removeClass("opacity-40")

            $('html, body').animate({
                scrollTop: $(".question-container:first").offset().top - 400
            }, 500);
            event.preventDefault();

            progress = (answered_questions / total_questions * 100).toFixed(0);

            $("#progress-bar").animate({width: progress + "%"});
            $("#progress-bar").text(progress + "%");

            $("#progres-bar-container").empty()
            $("#progres-bar-container").append([
                '<div id="progress-bar" total_questions=', total_questions, ' answered_questions=', answered_questions, ' class="h-full text-sm bg-gradient-to-r from-bgFifth to-bgThird rounded-full px-4 text-white text-center" style="width:', progress ,'%;"></div>'
            ].join(''))


            if(dimension_number > 1 ||
                indicator_number > 1 ||
                parseInt(questions[0].question_number) > 5){
                $("#prev-question-btn").removeAttr("disabled")
                $("#prev-question-btn").removeClass("hidden")
                $("#prev-question-btn-container").removeClass("bg-slate-500")
                $("#prev-question-btn-container").addClass("bg-bgThird")
            }
            else{
                $("#prev-question-btn-container").addClass("hidden")
            }

            let disabled = false

            $('.scale-container').each(function(){
                if($(this).find('.active-scale').length == 0){
                    disabled = true
                    return;
                }
            })

            if(!disabled){
                $("#next-question-btn").removeAttr("disabled")
                $("#next-question-btn-container").removeClass("bg-slate-500")
                $("#next-question-btn-container").addClass("bg-bgFourth")
            }

        }

        function prev_questions(){
            let token = $('meta[name="csrf-token"]').attr('content')

            let answerMap = new Map();

            $('.scale-container').each(function(){
                let questionId = $(this).attr('id').split('-')[1];
                let answerKey = parseInt($(this).find('.active-scale').text());
                answerMap.set(parseInt(questionId), parseInt(answerKey));
            });


            const answers = {};
            answerMap.forEach((value, key) => {
                answers[key] = value;
            });

            $.ajax({
                method: "POST",
                url: "/prev_questions",
                data: {
                    questionnaire: $('#current-questionnaire').text(),
                    dimension: $('#current-dimension').text(),
                    indicator : $('#current-indicator').text(),
                    question_number: $('#current-question-number').text(),
                    answers: answers,
                    city: $("#current-city").text()
                },
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                if(!response.error){

                    questionnaire = response.questionnaire
                    dimension = response.dimension
                    dimension_number = response.dimension_number
                    indicator_number = response.indicator_number
                    indicator = response.indicator
                    questions = response.questions
                    total_questions = response.total_questions
                    answered_questions = response.answered_questions
                    city = response.city 

                    refresh_views(questionnaire, city, dimension, dimension_number, indicator, indicator_number, questions, total_questions, answered_questions)
                }
                
            })
        }

        function next_questions(){
            let token = $('meta[name="csrf-token"]').attr('content')

            let answerMap = new Map();

            $('.scale-container').each(function(){
                let questionId = $(this).attr('id').split('-')[1];
                let answerKey = parseInt($(this).find('.active-scale').text());
                answerMap.set(parseInt(questionId), parseInt(answerKey));
            });


            const answers = {};
            answerMap.forEach((value, key) => {
                answers[key] = value;
            });

            let answered_questions = parseInt($("#progress-bar").attr("answered_questions"));

            if($(".question-container").length + answered_questions == total_questions){
                showLoading();
            }

            $.ajax({
                method: "POST",
                url: "/next_questions",
                data: {
                    questionnaire: $('#current-questionnaire').text(),
                    dimension: $('#current-dimension').text(),
                    indicator : $('#current-indicator').text(),
                    question_number: $('#current-question-number').text(),
                    answers: answers,
                    city: $("#current-city").text()
                },
                headers: {
                    'X-CSRF-TOKEN': token
                }
            }).done((response)=>{
                if(response.score){
                    hideLoading()
                    console.log(response)
                    popupSubmitted = {
                        text: "Thank you for your response! CPI Score Result: " + response.score,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#2B8CBE',
                        .
                    }

                    Swal.fire(popupSubmitted).then(result => {
                        if (result.isConfirmed) window.location.replace("/");
                    });
                }
                else if(!response.error){

                    questionnaire = response.questionnaire
                    dimension = response.dimension
                    dimension_number = response.dimension_number
                    indicator_number = response.indicator_number
                    indicator = response.indicator
                    questions = response.questions
                    total_questions = response.total_questions
                    answered_questions = response.answered_questions
                    city = response.city 

                    refresh_views(questionnaire, city, dimension, dimension_number, indicator, indicator_number, questions, total_questions, answered_questions)
                }
            })
        }

        function showLoading(){
            $("#loading-spin").show();
            $("#loading-spin").removeClass("opacity-20");
            $("#loading-spin").addClass("opacity-20");
        }

        function hideLoading(){
            $("#loading-spin").hide();
        }
        

        $(document).ready(function() {
            question_scale()
            $("#loading-spin").hide();
            $(".question-container:first").removeClass("opacity-40")

            if(parseInt($("#current-dimension").attr("dimension_number")) > 1 ||
                parseInt($("#current-indicator").attr("indicator_number")) > 1 ||
                parseInt($('#current-question-number').text()) > 5){
                $("#prev-question-btn").removeClass("hidden")
                $("#prev-question-btn").removeAttr("disabled")
                $("#prev-question-btn-container").removeClass("bg-slate-500")
                $("#prev-question-btn-container").addClass("bg-bgThird")
            }

            total_questions = $("#progress-bar").attr("total_questions");

            answered_questions = $("#progress-bar").attr("answered_questions");

            progress = (answered_questions / total_questions * 100).toFixed(0);

            $("#progress-bar").animate({width: progress + "%"});
            $("#progress-bar").text(progress + "%");

        });


    </script>
@endsection
