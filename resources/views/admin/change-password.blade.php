@extends('master/layout')
@section('content')

<div class="mx-auto mt-10 w-2/3">
    <div id="tab3" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md">
        <p class="font-bold text-3xl">Account Setting</p>
        <form action="/changePassword" class="" method="POST">
            @csrf
            <div class="w-full mt-4">
                <div class="">
                    <div class="mt-4">
                        <label for="" class="font-semibold">Email</label>
                        <br>
                        <input type="text" name="" id="" value={{Auth::user()->email}} disabled class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Current Password</label>
                        <br>
                        <input type="password" name="current_password" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">New Password</label>
                        <br>
                        <input type="password" name="password" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Confirm Password</label>
                        <br>
                        <input type="password" name="password_confirmation" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4">
                    </div>
                </div>
            </div>
            <div class="mt-4 flex justify-end w-full">
                <div class="mt-4 w-fit bg-myblue-2 rounded-md px-4 py-2 text-white">
                    <button type="submit" class="font-bold">Update</button>
                </div>
            </div>
            
        </form>
    </div>
</div>



<script>
        
</script>

@endsection