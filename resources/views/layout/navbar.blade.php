<div class="bg-blue-400 flex justify-between p-3 shadow-xl text-white items-center">
    <div>LOGO</div>
    <div class="flex justify-around gap-x-4 items-center">
        <div><a href="{{route('blog.index')}}">Blog</a></div>
        <div>Link</div>
        {{--if authenticated return a link to sign out, otherwise return the signin one--}}
        @auth
            <div class="avatar placeholder">
                <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                    {{--first letter of the auth user name--}}
                    <span class="text-xs"> {{substr(auth()->user()->name,0,1)}}  </span>
                </div>
            </div>
            <div class="font-bold italic" >{{auth()->user()->name}}</div>
            <form action="{{route('auth.logout')}}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn btn-error" type="submit">
                    Log out
                </button>
                <output></output>
            </form>
        @endauth
        @guest
            <div><a href="{{route('auth.login')}}">Sign in</a></div>
        @endguest
    </div>
</div>
