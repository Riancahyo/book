<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="mb-4">Daftar Buku</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr class="{{ $book->trashed() ? 'table-warning' : '' }}">
                                            <td class="text-center">{{ $book->id }}</td>
                                            <td class="text-center">{{ $book->user_id }}</td>
                                            <td class="text-center">{{ $book->title }}</td>
                                            <td class="text-center">{{ $book->author }}</td>
                                            <td class="text-center">{{ $book->description ?? '-' }}</td>
                                            <td class="text-center">{{ $book->status }}</td>
                                            <td class="text-center">{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                                            <td class="text-center">
                                                @if ($book->trashed())
                                                    <form action="{{ route('books.restore', $book->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                                    </form>
                                                    <form action="{{ route('books.forceDelete', $book->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus Permanen</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data buku.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginasi -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
