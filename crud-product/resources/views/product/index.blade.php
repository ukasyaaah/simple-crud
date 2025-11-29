@extends('layouts.base')
@section('title', 'Products Page')

@section('content')
    <nav class="flex gap-4 absolute top-4 right-4">
        <a href="{{ route('create') }}">
            <button class="bg-amber-500 text-white p-2 rounded-lg hover:cursor-pointer">Tambah Data</button>
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button onclick=" alert('Yakin mau Logout?') " type="submit"
                class="bg-red-500 text-white p-2 rounded-lg hover:cursor-pointer">Logout</button>
        </form>
    </nav>
    <div class="mb-10 items-center flex flex-col gap-y-4">
        <h2 class="font-bold text-3xl "> Daftar Product</h2>

    </div>
    <table class="w-full  rounded-lg overflow-hidden">
        <thead class=" bg-amber-500 text-white leading-normal">
            <tr class="border-b border-gray-200">
                <th class="py-3 px-6 text-left">No</th>
                <th class="py-3 px-6 text-left">Nama</th>
                <th class="py-3 px-6 text-left">Description</th>
                <th class="py-3 px-6 text-left">Image</th>
                <th class="py-3 px-6 text-left">Last Update</th>

                <th class="py-3 px-6 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
                {{-- {{ dd($product->image) }} --}}
                <img src="{{ $product->image }}" alt="">
                <tr class="border-b  border-gray-200">
                    <td class="py-3 px-6 text-left"> {{ $loop->iteration }} </td>
                    <td class="py-3 px-6 text-left"> {{ $product->name }} </td>
                    <td class="py-3 px-6 text-left"> {{ $product->description }} </td>
                    <td class="py-3 px-6 text-left"> <img class="min-w-20 rounded-lg"
                            src="{{ Storage::url($product->image) }}" alt="image">
                    </td>
                    <td class="py-3 px-6 text-left"> {{ $product->updated_at->format('M d, Y ') }} </td>
                    <td class="py-3 px-6  flex flex-col gap-2 text-center">
                        <a class="bg-amber-500 text-white p-2 rounded-lg hover:cursor-pointer"
                            href="/edit/{{ $product->id }}">Edit</a>
                        <a class='bg-amber-500 text-white p-2 rounded-lg hover:cursor-pointer'
                            onclick="return confirm('Yakin mau di hapus?')"
                            href="{{ route('destroy', ['id' => $product->id]) }}">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
