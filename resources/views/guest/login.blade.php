@extends("components/layout-guest")
@section("form")
<form action="/login" method="POST" class="">
    @csrf
    <p class="text-2xl font-bold text-center">Let's Head Inside</p>
    <div class="w-full mt-6">
        <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="text" name="email" id="" placeholder="Email" value={{old('email')}}>
    </div>
    <div class="w-full mt-6">
        <input class="rounded-md border-none w-full bg-bgSecondary py-2 px-4" type="password" name="password" id="" placeholder="Password">
    </div>
    <div class="w-full mt-6">
        <input class="rounded-md border-none w-full bg-bgFourth hover:bg-bgThird transition duration-500 ease-in-out cursor-pointer text-white py-2 px-4" type="submit" name="" id="" value="Login">
    </div>
    <div class="w-full mt-6 text-end">
        <a href="/register" class="text-bgFourth hover:underline text-end">I don't have an account</a>
        <br>
        <br>
        <a href="/forgot" class="text-bgFourth hover:underline text-end">Forgot Your Password?</a>
    </div>
</form>
@endsection()