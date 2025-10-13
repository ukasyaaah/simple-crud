@extends('components.layout')

@section('title', 'Employee Page')


@section('content')
    <div class="my-10 items-center flex flex-col gap-y-4">
        <h2 class="font-bold text-3xl "> Daftar Employee</h2>
        <a href="{{ route('create') }}">
            <button class="bg-red-500 text-white p-2 rounded-lg hover:cursor-pointer">Tambah Data</button>
        </a>
    </div>
    <table class="w-full rounded-lg overflow-hidden">
        <thead class=" bg-red-500 text-white leading-normal">
            <tr class="border-b border-gray-200">
                <th class="py-3 px-6 text-left">No</th>
                <th class="py-3 px-6 text-left">Nama</th>
                <th class="py-3 px-6 text-left">Gender</th>
                <th class="py-3 px-6 text-left">Usia</th>
                <th class="py-3 px-6 text-left">Updated</th>
                <th class="py-3 px-6 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($employees as $employee)
                <tr class="border-b  border-gray-200">
                    <td class="py-3 px-6 text-left"> {{ $loop->iteration }} </td>
                    <td class="py-3 px-6 text-left"> {{ $employee->name }} </td>
                    <td class="py-3 px-6 text-left"> {{ $employee->gender }} </td>
                    <td class="py-3 px-6 text-left"> {{ $employee->age }} </td>
                    <td class="py-3 px-6 text-left"> {{ $employee->updated_at }} </td>
                    <td class="py-3 px-6  flex flex-col gap-2 text-center">
                        <a class="bg-red-500 text-white p-2 rounded-lg hover:cursor-pointer"
                            href="/employee/edit/{{ $employee->id }}">Edit</a>
                        <a class='bg-red-500 text-white p-2 rounded-lg hover:cursor-pointer'
                            onclick="return confirm('Yakin mau di hapus?')"
                            href="{{ route('destroy', ['id' => $employee->id]) }}">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
