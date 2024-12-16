<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Arsip Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4">Loans yang dihapus</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('loans.index') }}" class="btn btn-primary mb-3">Kembali ke Daftar Loans</a>

                    <div class="card">
                        <div class="card-body w-full overflow-x-auto"> <!-- Menambahkan kelas w-full -->
                            <table class="table table-hover w-full"> <!-- Kelas w-full diterapkan pada tabel -->
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($loans as $loan)
                                        <tr>
                                            <td>{{ $loan->id }}</td>
                                            <td>{{ $loan->user->name ?? 'Guest' }}</td>
                                            <td>{{ $loan->book->title }}</td>
                                            <td>{{ $loan->loan_date }}</td>
                                            <td>{{ $loan->due_date }}</td>
                                            <td>{{ ucfirst($loan->status) }}</td>
                                            <td>
                                                <form action="{{ route('loans.restore', $loan->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                                </form>
                                                <form action="{{ route('loans.forceDelete', $loan->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus Permanen</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada loans yang dihapus.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $loans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
