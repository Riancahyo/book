<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4">Daftar Peminjaman</h1>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('loans.create') }}" class="btn btn-primary">Tambah Peminjaman Baru</a>
                        <a href="{{ route('loans.trashed') }}" class="btn btn-secondary ml-4">Lihat Arsip</a>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center">Buku</th>
                                        <th class="text-center">Tanggal Pinjam</th>
                                        <th class="text-center">Tanggal Kembali</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($loans as $loan)
                                        <tr class="{{ $loan->trashed() ? 'table-warning' : '' }}">
                                            <td class="text-center">{{ $loan->id }}</td>
                                            <td class="text-center">{{ $loan->user->name ?? 'Guest' }}</td>
                                            <td class="text-center">{{ $loan->book->title }}</td>
                                            <td class="text-center">{{ $loan->loan_date }}</td>
                                            <td class="text-center">{{ $loan->due_date }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $loan->status == 'returned' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($loan->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($loan->trashed())
                                                    <form action="{{ route('loans.restore', $loan->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                                    </form>
                                                    <form action="{{ route('loans.forceDelete', $loan->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus peminjaman ini secara permanen?')">Hapus Permanen</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus peminjaman ini?')">Hapus</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Paginasi -->
                    {{-- <div class="d-flex justify-content-center mt-4">
                        {{ $loans->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
