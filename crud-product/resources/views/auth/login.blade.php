@extends('layouts.base')

@section('title', 'Login Page')
@section('content')
    <div class="mb-10 items-center justify-center flex flex-col gap-y-4">
        <h2 class="font-bold text-3xl text-amber-500 "> Login</h2>
    </div>
    <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data"
        class=" border p-6 rounded-xl shadow-amber-800 shadow-2xl text-amber-500  w-full max-w-sm flex flex-col h-auto gap-3 ">
        @csrf
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="email">Email</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="email" name="email" id="email"
                value="{{ old('email') }}" placeholder="Email">
        </div>
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="password">Password</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="password" name="password" id="password"
                value="{{ old('password') }}" placeholder="Password">
        </div>

        <button type="submit" class="bg-amber-500 text-white p-2 rounded-lg mt-2 hover:cursor-pointer">Submit</button>
        <p class="font-semibold  text-center text-black">Belum punya akun?
            <a class="text-amber-500 hover:text-amber-700" href="{{ route('auth.register') }}">
                Register
            </a>
        </p>


        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </form>
@endsection
