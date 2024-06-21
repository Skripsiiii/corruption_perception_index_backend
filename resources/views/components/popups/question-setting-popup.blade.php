<div id="question-setting-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6 flex-row align-middle">
        <p class="text-2xl font-bold text-center">Question Setting</p>
        <div class="mt-4 text-center">
            <button id="edit-question-button" class="bg-myyellow-1 hover:bg-gradient-to-br from-myyellow-1 to-myyellow-2 transition duration-500 ease-in-out rounded-md py-1 px-3 text-white">
                Edit Question
            </button>
        </div>
        <div class="mt-4 text-center">
            <form id="delete-question-form" method="post" class="delete-form ">
                @csrf @method('DELETE')
                <button type="submit" id="delete-question-button" class="bg-myred-2 hover:bg-gradient-to-br from-myred-2 to-myred-1 transition duration-500 ease-in-out rounded-md py-1 px-3 text-white">
                    Delete Question
                </button>
            </form>
        </div>
        <div class="justify-center flex items-center text-white w-full mt-6">
            <button class="cancel-popup-button bg-mygrey-2 hover:bg-gradient-to-br from-mygrey-2 to-mygrey-3 rounded-md py-1 px-3">Cancel</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $("#edit-question-button").click(function(e){
            $("#question-setting-popup").hide();
            $("#edit-question-popup").show();
        })

        $("#delete-question-form").submit(function(e){
            e.preventDefault();
            $(this).attr("action", "/questions/" + $(this).closest("#question-setting-popup").attr("questionId"));
        })
    });
</script>