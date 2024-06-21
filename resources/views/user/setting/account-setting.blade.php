@extends("master/layout")
@section("content")
<div class="w-full">
    <div id="tab4" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md w-3/5 my-12 mx-auto">
        <p class="font-bold text-3xl">Change Password</p>
        <form action="{{Route('changePassword')}}" class="" method="POST">
            @csrf
            <div class="w-full mt-4">
                <div class="">
                    <div class="mt-4">
                        <label for="" class="font-semibold">Email</label>
                        <br>
                        <input type="text" name="" id="" value={{Auth()->user()->email}} disabled class="bg-bgSeventh rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Current Password</label>
                        <br>
                        <input type="password" name="current_password" id="" class="bg-bgSeventh rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">New Password</label>
                        <br>
                        <input type="password" name="password" id="" class="bg-bgSeventh rounded-md border-none w-full py-2 px-4">
                    </div>
                    <div class="mt-4">
                        <label for="" class="font-semibold">Confirm Password</label>
                        <br>
                        <input type="password" name="password_confirmation" id="" class="bg-bgSeventh rounded-md border-none w-full py-2 px-4">
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end flex justify-end">
                <div class="w-fit bg-bgThird rounded-md  text-black font-bold hover:bg-bgFourth">
                    <button type="submit" class="px-4 py-2 text-white ">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection()
