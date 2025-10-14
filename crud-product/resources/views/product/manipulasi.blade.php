@extends('layouts.base')

@section('title', isset($detailProduk) ? 'Edit Product' : 'Add Product')


@section('content')
    <div class="my-10 items-center flex flex-col gap-y-4">
        <h2 class="font-bold text-3xl text-amber-500 "> {{ isset($detailProduk) ? 'Edit ' : 'Tambah ' }} Product</h2>

    </div>
    <form action="{{ isset($detailProduk) ? route('update', ['id' => $detailProduk->id]) : route('store') }}" method="post"
        enctype="multipart/form-data"
        class=" border p-6 rounded-xl shadow-amber-800 shadow-2xl text-amber-500 max-w-xl flex flex-col h-auto gap-3 ">
        @if (isset($detailProduk))
            @method('put')
        @endif
        @csrf
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="name">Name</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="text" name="name" id="name"
                value="{{ old('name', $detailProduk->name ?? '') }}" placeholder="Name">

        </div>
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="description">Description</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent " type="text" name="description"
                value="{{ old('description', $detailProduk->description ?? '') }}" id="description"
                placeholder="Description">
        </div>
        <div class="flex flex-col gap-2">
            <label class="font-bold text-lg" for="image">Image</label>
            <input class="border-2 p-2 rounded-lg focus:ring-transparent"
                value="{{ old('image', $detailProduk->image ?? '') }}" type="file" name="image" accept="image/*"
                id="image">

        </div>
        <button type="submit" class="bg-amber-500 text-white p-2 rounded-lg mt-2 hover:cursor-pointer">Submit</button>

        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </form>
@endsection
