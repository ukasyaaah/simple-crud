@extends('components.layout')

@section('title', 'Add Employee Page')


@section('content')
    <div class="my-10 items-center flex flex-col gap-y-4">
        <h2 class="font-bold text-3xl text-red-500 "> Tambah Employee</h2>

    </div>
    <form action="{{ route('store') }}" method="POST"
        class=" border p-6 rounded-xl shadow-red-800 shadow-2xl text-red-500 max-w-xl flex flex-col h-auto gap-3 ">
        @csrf
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="name">Name</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="text" name="name" id="name"
                placeholder="Name">

        </div>
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="age">Age</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="number" name="age" id="age"
                placeholder="Age">
        </div>
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="age">Gender</label>
            <select class="border-2 p-2 rounded-lg focus:ring-transparent " type="number" name="gender" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
        <button type="submit" class="bg-red-500 text-white p-2 rounded-lg mt-2 hover:cursor-pointer">Submit</button>

        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </form>
@endsection
