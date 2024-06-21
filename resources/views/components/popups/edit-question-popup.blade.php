<div id="edit-question-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50 hidden">
    <div class="rounded-md bg-white drop-shadow-md w-1/4 m-auto mt-40 py-4 px-6">
        <p class="text-2xl font-bold text-center">Edit Question</p>
        <div class="mt-4">
          <input type="text" name="question_name" id="edit-question-name" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Question Name">
          <input type="text" name="leftmost_parameter" id="edit-question-leftmost" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Leftmost Parameter">
          <input type="text" name="rightmost_parameter" id="edit-question-rightmost" class="w-full py-2 px-4 mb-4 bg-mygrey-0" placeholder="Rightmost Parameter">
        </div>
        <div>
          <x-popups.error-message/>
        </div>
        <div class="justify-center flex items-center text-white w-full mt-6">
          <button class="cancel-popup-button bg-mygrey-2 rounded-md py-1 px-3">Cancel</button>
          <button id="submit-edit-question" class="bg-myblue-2 rounded-md py-1 px-3 ml-4">Submit</button>
        </div>
      </div>
</div>

<script>
  $(document).ready(()=>{

    $("#submit-edit-question").click(function(){
      let questionId = $(this).closest("#edit-question-popup").attr("questionId");
      let questionName = $("#edit-question-name").val();
      let leftmostParameter = $("#edit-question-leftmost").val();
      let rightmostParameter = $("#edit-question-rightmost").val();

      sendAjax("PUT", "/questions/" + questionId, {
          questionName: questionName,
          leftmostParameter: leftmostParameter,
          rightmostParameter :rightmostParameter
      });
    });

  })

</script>
