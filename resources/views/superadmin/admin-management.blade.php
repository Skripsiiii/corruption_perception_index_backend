@extends("master.layout")
@section("content")
<div class="mb-4">
    <div class="title-container px-10 pt-8">
        <p class="text-3xl font-bold">Admin Management</p>
    </div>
</div>
  
<div class="w-full px-10">
  <div class="bg-white drop-shadow-md rounded-lg py-4 px-6">
    <div class="title flex items-center justify-between">
        <div>
            <p class="font-bold text-2xl">Admins</p>
        </div>
        <div>
            <button id="add-admin-button" class="rounded-md bg-myyellow-2 text-white px-2 py-1">+ Add Admin</button>
        </div>

    </div>
    {{-- <div class="flex mt-4">
        <input type="search" name="" id="searchAdmin" placeholder="Search Name" class="bg-mygrey-0 mr-4 py-2 px-4">
      </div> --}}
    <div class="mt-4">
      <table class="w-full text-center">
        <thead class="bg-myyellow-2 text-white">
          <th class="py-2 px-4 border-collapse">Name</th>
          <th class="py-2 px-4 border-collapse">Email</th>
          <th class="py-2 px-4 border-collapse">Role</th>
          <th class="py-2 px-4 border-collapse">Registered At</th>
          <th class="py-2 px-4 border-collapse">Action</th>
        </thead>
        <tbody id="admin-container">
          @foreach ($users as $user)
            <tr class="border-b-2 border-mygrey-0 text-center">
                <td class="py-2">{{$user->name}}</td>
                <td class="py-2">{{$user->email}}</td>
                <td class="py-2">{{$user->role->name}}</td>
                <td class="py-2">{{optional(\Carbon\Carbon::parse($user->created_at))->toDateString() ?? '-'}}</td>
                    @if (Auth::user()->id == $user->id)
                        <td class="text-center border-collapse">
                            <p class="text-black text-center">Yourself</p>
                        </td> 
                    @elseif (!$user->is_accepted)
                        <td class="text-center border-collapse flex items-center justify-center text-lg mt-1">
                            <form action={{"/admins/accept/" . $user->id}} method="put" class="accept-admin-form mb-0 mr-2">
                                @csrf
                                @method("PUT")
                                <button type="submit">
                                    <i class="fa fa-check text-mygreen-1 hover:text-mygreen-2"></i>
                                </button>
                            </form>
                            <form action={{route('admins.destroy', ['admin' => $user->id])}} method="post" class="delete-form mb-0 ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn delete-button">
                                    <i class="fa fa-xmark text-center text-myred-1 hover:text-myred-2"></i>
                                </button>
                            </form>
                        </td>            
                    @else
                        @if($user->role_id != 1)
                            <td class="text-center border-collapse justify-center items-center flex mt-1">
                                <form action={{"/admins/promote/" . $user->id}} method="put" class="promote-admin-form mb-0 mr-2">
                                    @csrf
                                    @method("PUT")
                                    <button type="submit">
                                        <i class="fa fa-turn-up text-mygreen-1 hover:text-mygreen-2"></i>
                                    </button>
                                </form>
                                <form action={{route('admins.destroy', ['admin' => $user->id])}} method="post" class="delete-form mb-0 ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-button"><i class="fa fa-trash text-center text-myred-1 hover:text-myred-2"></i></button>
                                </form>
                            </td>
                        @else
                            <td class="text-center border-collapse justify-center items-center flex mt-1"></td>
                        @endif
                    @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      {{$users->links()}}
    </div>
  </div>
</div>

<div id="add-admin-popup" class="popup-container fixed inset-0 center z-99 w-full h-full bg-black bg-opacity-50">
    <div class="rounded-md bg-white drop-shadow-md w-1/3 m-auto mt-40 mx-auto py-4 px-6">
        <p class="text-2xl font-bold text-center">Add New Admin</p>
        <div class="mt-2">
            <p class="italic text-sm text-center">Default password will be the admin name</p>
        </div>
        <div class="mt-4">
            <input type="text" name="" id="new-admin-name" class="w-full py-2 px-4 bg-myyellow-0" placeholder="Name">
        </div>
        <div class="mt-4">
            <input type="email" name="" id="new-admin-email" class="w-full py-2 px-4 bg-myyellow-0" placeholder="Email">
        </div>
        <div>
            <xpopups.-error-message/>
        </div>
        <div class="justify-center text-center text-white w-full mt-6">
            <x-buttons.cancel-button/>
            <button id="submit-admin" class="bg-myyellow-2 rounded-md py-1 px-3 mr-2">Add Admin</button>
        </div>
    </div>
</div>

<script>

      $("#add-admin-popup").hide();

    $("#add-admin-button").click((e)=>{
        e.preventDefault();
        $("#add-admin-popup").show();
    });

    $("#submit-admin").click(function(){
        console.log("aaa");
        sendAjax("POST", "/admins", {
        name: $("#new-admin-name").val(),
        email: $("#new-admin-email").val()
        })
    })

</script>
@endsection()