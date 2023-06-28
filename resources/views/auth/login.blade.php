@extends('base')
@section('title', 'Login')
@section('content')
    <div class="flex w-full justify-center items-center">
        <div class="flex flex-col w-1/3 h-auto bg-white p-4 rounded-2xl shadow-xl">
            <h1 class="text-2xl font-black text-center mb-1.5" >Sign in</h1>
            {{--print session message--}}
            @if(session()->has('logout'))
                <div class="alert alert-success shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{session()->get('logout')}}</span>
                    </div>
                </div>
            @endif
            <form action="{{route('auth.login')}}" method="post" class="form-control flex gap-3">
                @csrf
                <label class="label">
                    email
                </label>
                <input
                    type="email"
                    name="email"
                    placeholder="example@email.com"
                    class="input input-bordered w-full"
                    value="{{old('email')}}"
                />
                @error('email') {{$message}} @enderror
                <label class="label">
                    password
                </label>
                <input type="password" name="password" class="input input-bordered w-full" />
                @error('password') {{$message}} @enderror
                <input type="submit" value="Sign in" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection
