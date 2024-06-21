@extends("master.layout")
@section("content")
<div class="mb-4 px-10 mt-8">
    <div class="title-container">
        <p class="text-3xl font-bold">User Detail</p>
        <div class="flex items-center text-mygrey-3">
          <a class="hover:underline" href="/participants">User Management </a>
          <p class="ml-1"> / User Detail</p>
        </div>
    </div>
</div>

<div class="md:flex justify-between px-10">
    <div class="w-full md:w-1/2 bg-white rounded-md drop-shadow-md py-4 px-6">
      <p class="font-semibold text-2xl mb-4">User Profile</p>
      <div class="flex py-1 w-full text-left">
        <p class="py-1 px-2 font-semibold bg-myblue-2 text-white w-2/5">Full Name</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->name}}</p>
      </div>
      <div class="flex py-1 w-full text-left">
        <p class="py-1 px-2 font-semibold bg-myblue-2 text-white w-2/5">Gender</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->gender}}</p>
      </div>
      <div class="flex  py-1 w-full text-left">
        <p class="py-1 px-2 font-semibold bg-myblue-2 text-white w-2/5">Age</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->age->name}}</p>
      </div>
      <div class="flex  py-1 w-full text-left">
        <p class="py-1 px-2 font-semibold bg-myblue-2 text-white w-2/5">Education</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->education->name ?? '-'}}</p>
      </div>
      <div class="flex  py-1 w-full text-left">
        <p class="py-1 px-2 font-semibold bg-myblue-2 text-white w-2/5">Occupation</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->occupation->name ?? '-'}}</p>
      </div>
      <hr class="my-4" size="4" color="grey" width="100%" align="center">
      <div class="flex  py-1 w-full text-left">
        <p class="py-1 px-2  bg-myblue-2 text-white w-2/5">Registered at</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->created_at}}</p>
      </div>
      <div class="flex  py-1 w-full text-left">
        <p class="py-1 px-2  bg-myblue-2 text-white w-2/5">Last Updated at</p>
        <p class="py-1 px-2 w-3/5 bg-myblue-0">{{$participant->updated_at}}</p>
      </div>

      <hr class="my-4" size="4" color="grey" width="100%" align="center">
      <p class="font-semibold text-xl">Domiciles History</p>
      @foreach ($participant->domiciles as $domicile)
        <div class="mt-4">
          <p class="text-lg">{{$domicile->city->province->name}}</p>
          <p class="italic">Since {{$domicile->start_date}} to {{$domicile->end_date ?? " Now"}}</p>
        </div>
      @endforeach
      @if ($participant->domiciles->count() == 0)
        <div class="mt-4 text-center">
          <p>There's no domicile history for this user</p>
        </div>
      @endif
      <hr class="my-4" size="4" color="grey" width="100%" align="center">
      <p class="font-semibold text-xl">Reponses History</p>
      @foreach ($participant->responses()->orderBy("created_at", "desc")->get() as $response)
        <div class="mt-4">
          <a href={{"/responses/response/". $response->id}} class="mt-4 hover:text-myblue-2">
            <div class="flex items-center">
              <p class="text-lg">{{$response->questionnaire->year}} Questionnaire</p>
              <div class="rounded-full ml-2 px-2 py-1 bg-myblue-0 text-myblue-2 text-xs font-bold">CPI Score: {{round($response->corruption_index,1)}} / 100</div>
            </div>
            <p class="text-md">{{$response->city->province->name}}, {{$response->city->name}}</p>
            <p class="text-sm italic">Responded at {{($response->created_at)}}</p>
          </a>                
        </div>
      @endforeach
      @if ($participant->responses->count() == 0)
        <div class="mt-4 italic">
          <p>There's no response history for this user</p>
        </div>
      @endif
    </div>

    <div class="w-full md:w-1/2 bg-white mt-8 md:mt-0 md:ml-8 drop-shadow-md rounded-md py-4 px-6">
      <p class="font-semibold text-2xl mb-4">Viewpoints Data</p>
      @foreach (\App\Models\ViewpointType::all() as $viewpoint_type)
          <div class="mt-4">
              <div class="items-center">
                  <p class="text-justify">{{ $viewpoint_type->name }}</p>
                  <select name="{{ $viewpoint_type->id }}" id="" class="bg-myblue-0 rounded-md border-none w-full py-2 px-4 appearance-none" disabled>
                      @if (\App\Models\Viewpoint::where('user_id', $participant->id)->where('viewpoint_type_id', $viewpoint_type->id)->where('is_effective', 1)->first())
                          <option value=1 selected disabled>Effective</option>
                          <option value=0 disabled>Not Effective</option>
                      @else
                          <option value=1 disabled>Effective</option>
                          <option value=0 selected disabled>Not Effective</option>
                      @endif
                  </select>
              </div>
          </div>
      @endforeach
    </div>

</div>

@endsection()