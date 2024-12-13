<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="space-y-6">
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- ID Peminjaman -->
                        <div>
                            <x-input-label value="ID Peminjaman" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->id }}
                            </p>
                        </div>

                        <!-- Nama Peminjam -->
                        <div>
                            <x-input-label value="Nama Peminjam" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->user->name }}
                            </p>
                        </div>

                        <!-- Buku yang Dipinjam -->
                        <div>
                            <x-input-label value="Buku" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->book->title }}
                            </p>
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div>
                            <x-input-label value="Tanggal Pinjam" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}
                            </p>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div>
                            <x-input-label value="Tanggal Kembali" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y') : 'Belum Kembali' }}
                            </p>
                        </div>

                        <!-- Status Peminjaman -->
                        <div>
                            <x-input-label value="Status" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $loan->status }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('loans.edit', $loan->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Edit') }}
                            </a>

                            <a href="{{ route('loans.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Kembali') }}
                            </a>

                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">
                                    {{ __('Hapus') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
