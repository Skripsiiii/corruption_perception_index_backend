
{{-- <a href="/{{$href}}" class=" text-white flex items-center cursor-pointer hover:bg-myblue-1 w-full py-4 px-6 m-0 {{request()->is($href) || request()->is($href . '/*') || request()->is($href . '/*/*') ? 'bg-myblue-1' : ''}}">
    <i class="sidebar-item-icon mr-3 text-2xl fa-solid {{$icon}}"></i><p class="sidebar-item-text font-bold m-0">{{$name}}</p>
</a> --}}

<a href="{{$href}}">
    <div class="Icon my-1 cursor-pointer flex items-center py-3 hover:bg-gray-200 rounded-md {{request()->is($href) || request()->is($href . '/*') || request()->is($href . '/*/*') ? 'bg-gray-100' : ''}}">
        <div class="min-w-16 flex justify-center text-2xl mr-3">
            <i class="{{$icon}} {{'text-' . $color}}"></i>
        </div>
        <div class="min-w-32 font-semibold">{{$name}}</div>
    </div>
</a>