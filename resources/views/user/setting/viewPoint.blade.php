@extends('master/layout')
@section('content')
    <div class="w-full">

        <div id="tab5" class="tab-content py-6 px-4 bg-white drop-shadow-md rounded-md w-[60%] mx-auto my-12">
            <p class="font-bold text-3xl">Viewpoints Data</p>

            <div class="">
                <form action="/viewPointUpdate" class="" method="POST">
                    @csrf
                    @foreach (\App\Models\ViewpointType::all() as $viewpoint_type)
                        <div class="mt-4">
                            <div class="items-center">
                                <p class="text-justify">{{ $viewpoint_type->name }}</p>
                                <select name="{{ $viewpoint_type->id }}" id="" class="bg-bgSeventh rounded-md border-none w-full py-2 px-4 appearance-none">
                                    @if (\App\Models\Viewpoint::where('user_id', Auth()->user()->id)->where('viewpoint_type_id', $viewpoint_type->id)->where('is_effective', 1)->first())
                                        <option value=1 selected>Effective</option>
                                        <option value=0>Not Effective</option>
                                    @else
                                        <option value=1>Effective</option>
                                        <option value=0 selected>Not Effective</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 text-end flex justify-end">
                        <div class="mt-4 text-end">
                            <div class="rounded-md  bg-bgThird text-white font-bold hover:bg-bgFourth">
                                <button type="submit" id="add-domicile-button" class="px-4 py-2">Update</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection()
