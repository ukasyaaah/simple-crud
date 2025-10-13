<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .action-buttons {
            white-space: nowrap;
        }

        .action-buttons a {
            color: #000;
            text-decoration: none;
        }

        .table-responsive {
            margin-top: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Daftar Buku</h1>
        @if (session('success'))
            <div class="alert alert-dismissable alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close justify-end " data-bs-dismiss='alert'
                    aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert  alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="Close"></button>
            </div>
        @endif
        <!-- Tabel Data Buku -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Buku 1 -->

                    @foreach ($buku as $book)
                        <tr>
                            <td> {{ $loop->iteration }} </td>
                            <td>{{ $book->judul }}</td>
                            <td>{{ $book->pengarang }}</td>
                            <td>{{ $book->tahun_terbit }}</td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-warning">
                                    <a href=" {{ route('buku.edit', ['id' => $book->id]) }} ">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </button>
                                <form class="d-inline" action=" {{ route('buku.destroy', ['id' => $book->id]) }} " method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Tambah Data (opsional) -->
        <div class="mt-4 p-3 bg-light rounded">
            <h3> {{ isset($detailBuku) ? 'Edit Buku' : 'Tambah Buku' }} </h3>
            <form action="{{ isset($detailBuku) ? route('buku.update', ['id' => $book->id]) : route('buku.store') }}"
                method="post">
                @csrf
                @if (isset($detailBuku))
                    @method('put')
                @endif
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul"
                        value="{{ old('judul', $detailBuku->judul ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang"
                        value="{{ old('pengarang', $detailBuku->pengarang ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900"
                        max="2099" value="{{ old('tahun_terbit', $detailBuku->tahun_terbit ?? '') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
