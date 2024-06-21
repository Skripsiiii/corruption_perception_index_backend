@extends('master/layout')
@section('content')
    <div class="w-full ">
        <div id="tab1" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md w-3/5 my-12 mx-auto">
            <p class="font-bold text-3xl">Edit Profile</p>
            <form action="/updateProfile" class="" method="POST">
                @csrf
                <div class="w-full mt-4">
                    <div class="">
                        <div class="mt-4">
                            <label for="" class="font-semibold">Name</label>
                            <br>
                            <input type="text" name="name" id="" value={{ Auth()->user()->name }}
                                class="bg-bgSeventh rounded-md border-none w-full py-2 px-4">
                        </div>
                        <div class="mt-4">
                            <label for="" class="font-semibold">Gender</label>
                            <br>
                            <select name="gender" id=""
                                class="bg-bgSeventh rounded-md border-none w-full py-2 px-4 appearance-none">
                                @if (Auth()->user()->gender == 'Male')
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                @else
                                    <option value="Male">Male</option>
                                    <option value="Female" selected>Female</option>
                                @endif
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="" class="font-semibold">Age Category</label>
                            <br>
                            <select name="age" id=""
                                class="bg-bgSeventh rounded-md border-none w-full py-2 px-4 appearance-none">

                                @foreach (\App\Models\Age::all() as $age_option)
                                    @if (Auth()->user()->age_id == $age_option->id)
                                        <option value={{ $age_option->id }} selected>{{ $age_option->name }}</option>
                                    @else
                                        <option value={{ $age_option->id }}>{{ $age_option->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="" class="font-semibold">Last Education</label>
                            <br>
                            <select name="education" id=""
                                class="bg-bgSeventh rounded-md border-none w-full py-2 px-4 appearance-none">
                                @foreach (\App\Models\Education::all() as $education_option)
                                    @if (Auth()->user()->education_id == $education_option->id)
                                        <option value={{ $education_option->id }} selected>{{ $education_option->name }}
                                        </option>
                                    @else
                                        <option value={{ $education_option->id }}>{{ $education_option->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="" class="font-semibold">Occupation</label>
                            <br>
                            <select name="occupation" id=""
                                class="bg-bgSeventh rounded-md border-none w-full py-2 px-4 appearance-none">
                                @foreach (\App\Models\Occupation::all() as $occupation_option)
                                    @if (Auth()->user()->occupation_id == $occupation_option->id)
                                        <option value={{ $occupation_option->id }} selected>{{ $occupation_option->name }}
                                        </option>
                                    @else
                                        <option value={{ $occupation_option->id }}>{{ $occupation_option->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-end flex justify-end">
                    <div
                        class="w-fit bg-bgThird rounded-md  text-black font-bold hover:bg-bgFourth">
                        <button type="submit" class="px-4 py-2 text-white ">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $("#add-domicile-popup").hide();

            $("#add-domicile-button").click(function(e) {
                e.preventDefault();
                $("#add-domicile-popup").show();
            });

        })
    </script>
@endsection()
