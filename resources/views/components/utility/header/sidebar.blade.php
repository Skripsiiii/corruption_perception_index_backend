<div id="sidebar"
    class="fixed w-60 -left-full lg:left-0 lg:w-20 lg:fixed h-screen px-2 py-4 z-20 shadow-lg border-black bg-white ease-in-out duration-300">
    <div class='h-full w-full flex flex-col'>
        <div class='flex flex-col justify-between box-border h-full overflow-hidden'>

            <div class="Title-container h-12 w-full flex items-center mb-8">
                <div class="min-w-16 flex justify-center h-full items-center box-border mr-3">
                    @if (Auth::user()->role_id != 3)
                        <a href="/" class="font-bold text-md rounded-md p-2 bg-myblue-2 text-white">CPI</a>
                    @else 
                        <a href="/" class="font-bold text-md rounded-md p-2 bg-bgThird text-white">CPI</a>
                    @endif
                </div>
                <div class="min-w-32 h-full leading-4 flex flex-col justify-center ">
                    <p class="font-bold">
                        Corruption
                    </p>
                    <p class="font-thin">
                        Perception Index
                    </p>
                </div>
            </div>

            <div class='flex flex-col justify-between box-border h-full'>
                <div class='top w-full flex flex-col'>
                    {{-- user --}}
                    {{-- <a href="/">
                        <div class="Icon cursor-pointer flex items-center py-3 hover:bg-gray-200 rounded-md">
                            <div class="min-w-16 flex justify-center text-2xl mr-3">
                                <i class="uil uil-create-dashboard text-bgThird"></i>
                            </div>
                            <div class="min-w-32 font-semibold">Home</div>
                        </div>
                    </a> --}}

                    @if (Auth::user()->role_id == 2)
                        <x-sidebar-item :href="'/questionnaire/2023'"  :name="'Questions'" :icon="'fa-solid fa-question'" :color="'myblue-2'"/>
                        <x-sidebar-item href="/responses/2023"  :name="'Responses'" :icon="'fa-solid fa-square-poll-vertical'" :color="'myblue-2'"/>
                        <x-sidebar-item href="/participants"  :name="'Participant'" :icon="'uil uil-user'" :color="'myblue-2'"/>
                    @elseif (Auth::user()->role_id == 1)
                        <x-sidebar-item :href="'/questionnaire/2023'"  :name="'Questions'" :icon="'fa-solid fa-question'" :color="'myblue-2'"/>
                        <x-sidebar-item href="/responses/2023"  :name="'Responses'" :icon="'fa-solid fa-square-poll-vertical'" :color="'myblue-2'"/>
                        <x-sidebar-item href="/participants"  :name="'Users'" :icon="'uil uil-user'" :color="'myblue-2'"/>
                        <x-sidebar-item href="/admins"  :name="'Admin'" :icon="'uil uil-unlock-alt'" :color="'myyellow-2'"/>
                    @endif
                    <div class="h-4 mb-8">
                    </div>
                    @if (Auth::user()->role_id == 3)
                    
                        <x-sidebar-item href="/questionnaire"  :name="'Questionnaire'" :icon="'uil uil-file-question-alt'" :color="'bgThird'"/>
                    @endif
                    <x-sidebar-item href="/map"  :name="'Map'" :icon="'uil uil-map'" :color="'bgThird'"/>
                    <x-sidebar-item href="/provinceData"  :name="'Data'" :icon="'uil uil-table'" :color="'bgThird'"/>
                    {{-- <i class="fa-solid fa-list"></i> --}}
                    

                    {{-- end user --}}
                </div>
                <div class='bottom'>
                    <a href="/logout">
                    <div class="Icon cursor-pointer flex items-center py-3 hover:bg-gray-200 rounded-md">
                        <div class="min-w-16 flex justify-center text-3xl mr-3">
                                <i class="uil uil-signout text-myred-1"></i>
                        </div>

                            <div class="min-w-32 font-semibold">Logout</div>

                    </div>
                </a>
                </div>
            </div>

        </div>
    </div>
</div>
