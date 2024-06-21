@extends("master.layout")
@section("content")
<div class="mb-4 px-10 pt-8">
    <div class="title-container">
        <p class="text-3xl font-bold">User Management</p>
    </div>
</div>
  
<div class="w-full px-10">
  <div class="bg-white drop-shadow-md rounded-lg py-4 px-6">
    <div class="title flex items-center justify-between">
        <p class="font-bold text-2xl">Users</p>
    </div>

    <div class="md:flex mt-4">
      <input type="search" name="" id="searchParticipant" placeholder="Search Users" class="bg-myblue-0 mr-4 py-2 px-4">
      {{-- <form action="" method="get" class="mb-0">
          <select name="" id="provinceFilterParticipant" class="mt-4 md:mt-0 bg-myblue-0 mr-4 py-2 px-4 appearance-none">
              <option value=0 selected>Any Province</option> 
              @foreach (App\Models\Province::all() as $province_option)
                      <option value={{$province_option->id}} {{isset($province) && $province_option->id == $province->id ? "selected" : ""}} >{{$province_option->name}}</option> 
              @endforeach
          </select>
      </form>
      <form action="" method="get" class="mb-0 mt-4 md:mt-0">
          <select name="" id="cityFilterParticipant" class="bg-myblue-0 mr-4 py-2 px-4 appearance-none">
              <option value="0" selected>Any City</option>
          </select>
      </form> --}}
    </div>

    <div class="mt-4">
      <table class="w-full text-left overflow-x-auto">
        <thead class="bg-myblue-2 text-white">
          <th class="py-2 px-4 border-collapse text-center">Name</th>
          <th class="py-2 px-4 border-collapse text-center">Age</th>
          <th class="py-2 px-4 border-collapse text-center">Gender</th>
          <th class="py-2 px-4 border-collapse text-center">Email</th>
          <th class="py-2 px-4 border-collapse text-center">Verified</th>
          <th class="py-2 px-4 border-collapse text-center ">Registered at</th>
          <th class="py-2 px-4 border-collapse">Action</th>
        </thead>
        <tbody id="participant-container">
          @foreach ($users as $user)
            <tr class="border-b-2 border-myblue-0">
              <td class="py-2 text-center">{{$user->name}}</td>
              <td class="py-2 text-center">{{$user->age->name}}</td>
              <td class="py-2 text-center">{{$user->gender}}</td>
              <td class="py-2 text-center">{{$user->email}}</td>
              <td class="py-2 text-center">
                <p class="rounded-full text-xs text-center px-1 py-1 {{$user->email_verified_at != null ? "bg-mygreen-0 text-mygreen-1" : "bg-red-200 text-red-800"}}">
                    {{$user->email_verified_at != null ? "verified" : "not verified"}}
                </p>
              </td>
              <td class="py-2 text-center">{{$user->created_at}}</td>
              <td class="py-2 pr-8 flex items-center justify-between">
                <a href="/participants/{{$user->id}}" class="pl-4">
                  <i class="fa-solid fa-eye text-center text-mygrey-3 hover:text-myblue-2"></i>
                </a>
                <form action='{{"/participants/" . $user->id}}' method="delete" class="delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="submit">
                    <i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{$users->links()}}

  </div>
</div>

<div class="title flex mt-8 w-full px-10 items-center justify-between">
  <p class="font-bold text-2xl">Users Chart</p>
</div>
  <div class="md:flex  justify-start mt-4 px-10">
    <div class="content-left-container w-full md:w-1/2">
      <div class="bg-white drop-shadow-md rounded-lg py-4 px-6">
          <div class="title">
            <p class="font-bold text-center">Users Region Statistics</p>
        </div>
          <canvas id="myChart-city" style="max-height: 400px;"></canvas>
      </div>
    </div>
    <div class="content-left-container w-full md:w-1/2 mt-8 md:mt-0 md:ml-8">
      <div class="bg-white drop-shadow-md rounded-lg py-4 px-6">
          <div class="title">
            <p class="font-bold text-center">Users Gender Statistics</p>
        </div>
          <canvas id="myChart-gender" style="max-height: 400px;"></canvas>
      </div>
    </div>  
  </div>

<script>

   $(document).ready(()=>{

    let ageCounts = {!! json_encode($ageCounts ?? '') !!};
    let provinceCounts = {!! json_encode($provinceCounts ?? '') !!};
    let genderCounts = {!! json_encode($genderCounts ?? '') !!};

    createChart("pie", "myChart-city", Object.keys(provinceCounts), Object.values(provinceCounts));
    createChart("pie", "myChart-gender", Object.keys(genderCounts), Object.values(genderCounts));

    function searchParticipantAjax(){
        let token = $('meta[name="csrf-token"]').attr('content')
        let provinceId = $("#provinceFilterParticipant").val();
        let query = $("#searchParticipant").val();
        let cityId = $("#cityFilterParticipant").val();

        $.ajax({
            method: 'GET',
            url: '/searchParticipant',
            data: {
                query: query,
                provinceId: provinceId,
                cityId: cityId,
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
              $("#participant-container").empty();
              let users = response.users
  
              users.data.forEach(p => {

                let text = ['<tr class="border-b-2 border-bgSeventh">',
                      '<td class="py-2 text-center">', p.name ,'</td>',
                      '<td class="py-2 text-center">', p.age_name, '</td>',
                      '<td class="py-2 text-center">', p.gender, '</td>',
                      '<td class="py-2 text-center">', p.email, '</td>'].join('')

                    console.log(p.email_verified_at)

                if (p.email_verified_at != null){
                  console.log("not null")
                  text += ['<td class="py-2 text-center"><p class="rounded-full text-xs text-center px-1 py-1 bg-mygreen-0 text-mygreen-1">verified</p></td>'].join('')
                }
                else{
                  console.log("null")
                  text += ['<td class="py-2 text-center"><p class="rounded-full text-xs text-center px-1 py-1 bg-red-200 text-red-800">not verified</p></td>'].join('')
                }

                text += [
                  '<td class="py-2 text-center">', p.created_at, '</td>',
                  '<td class="py-2 pr-8 flex items-center justify-between">',
                    '<a href="/participants/', p.id , '" class="pl-4">',
                      '<i class="fa-solid fa-eye text-center text-mygrey-3 hover:text-myblue-2"></i>',
                    '</a>',
                    '<form action="/participants/', p.id ,' method="post" class="delete-form">',
                      '@csrf @method("DELETE")',
                      '<button type="submit">',
                        '<i class="fa-solid fa-trash text-myred-1 hover:text-myred-2"></i>',
                      '</button>',
                    '</form>',
                  '</td>',
                '</tr>'
                  ].join('')

                $("#participant-container").append(text)


              });
            }
        })
    }
    
    function getCitiesAjax(provinceId){
        let token = $('meta[name="csrf-token"]').attr('content')

        $.ajax({
            method: 'GET',
            url: '/getCities',
            data: {
                provinceId: provinceId,
            },
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).done((response)=>{
            if(!response.error){
                let cities = response.cities
                $("#cityFilterParticipant").empty();
                $("#cityFilterParticipant").append('<option value=0>Any City</option>');
                cities.forEach(c => {
                    $("#cityFilterParticipant").append([
                        '<option value=', c.id ,'selected>', c.name ,'</option>',
                    ].join(''))
                });
            }
        })
    }

    $("#provinceFilterParticipant").on("change", function(){
        searchParticipantAjax();

        let provinceId = $(this).val();

        if(provinceId != 0){
            getCitiesAjax(provinceId);   
        }
        else{
            $("#cityFilterParticipant").empty();
            $("#cityFilterParticipant").append('<option value=0>Any City</option>');
        }
    })

    $("#cityFilterParticipant").on("change", function(){
        searchParticipantAjax();
    })

    $(document).on('keyup', '#searchParticipant', function(){
        searchParticipantAjax();
    })
  })

</script>
@endsection()