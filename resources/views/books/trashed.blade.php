<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-left">
                    <h1 class="mb-4">Buku yang Dihapus</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('books.index') }}" class="btn btn-primary mb-3">Kembali ke Daftar Buku</a>

                    <div class="card w-full">
                        <div class="card-body">
                            <table class="table table-hover w-full">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr>
                                            <td class="text-center">{{ $book->id }}</td>
                                            <td class="text-center">{{ $book->title }}</td>
                                            <td class="text-center">{{ $book->author }}</td>
                                            <td class="text-center">{{ $book->status }}</td>
                                            <td class="text-center">{{ $book->category->name ?? 'Tanpa Kategori' }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('books.restore', $book->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                                </form>
                                                <form action="{{ route('books.force-delete', $book->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus Permanen</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-left">Tidak ada buku yang dihapus.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>