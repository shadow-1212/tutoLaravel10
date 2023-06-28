<div>
    <h1 class="font-black text-3xl text-center" >Contact publisher</h1>
    @if(session()->has('success_mail'))
        <div class="alert alert-success">
            {{session('success_mail')}}
        </div>
    @endif
    <form action="{{route('blog.contact',$post)}}" method="POST" class="form-control w-full" >
        @csrf
        <label for="name" class="label">Name</label>
        <input type="text" name="name"  class="input input-bordered w-full ">
        @error('name') {{$message}} @enderror
        <label for="email" class="label">Email</label>
        <input type="email" name="email"  class="input input-bordered w-full ">
        @error('email') {{$message}} @enderror
        <label for="message">Message</label>
        <textarea  name="message" class="textarea textarea-bordered textarea-lg w-full "></textarea>
        @error('message') {{$message}} @enderror
        <button type="submit" class="btn btn-success mt-3">
            Send message
        </button>
    </form>
</div>
