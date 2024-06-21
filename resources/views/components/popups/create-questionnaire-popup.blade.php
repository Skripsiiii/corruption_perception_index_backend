<div id="add-questionnaire-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/3 m-auto mt-20 mx-auto py-4 px-6">
        <p class="text-2xl font-bold text-center">Add New Questionnaire</p>
        <div class="mt-4">
            <input type="number" name="" id="new-questionnaire-year" class="w-full py-2 px-4 bg-mygrey-0" placeholder="Questionnaire Year">
        </div>
        <div>
            <xpopups.-error-message/>
        </div>
        <div class="justify-center text-center text-white w-full mt-6">
            <div class="mt-4 text-center justify-center flex items-center">
                <button id="submit-questionnaire-scratch" class="bg-myblue-2 hover:bg-gradient-to-br from-myblue-2 to-myblue-3 transition duration-500 ease-in-out rounded-md py-1 px-3 mr-2">Create From Scratch</button>
                <button id="submit-questionnaire-copy" class="bg-myblue-2 hover:bg-gradient-to-br from-myblue-2 to-myblue-3 transition duration-500 ease-in-out rounded-md py-1 px-3 ml-2">Copy Previous Year Data</button>
            </div>
            <div class="mt-4 text-center">
                <x-buttons.cancel-button/>
            </div>
        </div>
    </div>
</div>
