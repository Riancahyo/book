<x-app3-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
                        @csrf

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Nama Peminjam -->
                        <div>
                            <x-input-label for="user_id" value="Nama Peminjam" />
                            <select name="user_id" id="user_id" class="mt-1 block w-full" required>
                                <option value="">Pilih Peminjam</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Buku yang Dipinjam -->
                        <div>
                            <x-input-label for="book_id" value="Buku yang Dipinjam" />
                            <select name="book_id" id="book_id" class="mt-1 block w-full" required>
                                <option value="">Pilih Buku</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>

                        <!-- Tanggal Peminjaman -->
                        <div>
                            <x-input-label for="loan_date" value="Tanggal Peminjaman" />
                            <x-text-input 
                                id="loan_date" 
                                name="loan_date" 
                                type="date" 
                                class="mt-1 block w-full" 
                                value="{{ old('loan_date') }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('loan_date')" class="mt-2" />
                        </div>

                        <!-- Tanggal Pengembalian -->
                        <div>
                            <x-input-label for="due_date" value="Tanggal Pengembalian" />
                            <x-text-input 
                                id="due_date" 
                                name="due_date" 
                                type="date" 
                                class="mt-1 block w-full" 
                                value="{{ old('due_date') }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <!-- Status Peminjaman -->
                        <div>
                            <x-input-label for="status" value="Status Peminjaman" />
                            <select name="status" id="status" class="mt-1 block w-full" required>
                                <option value="Dipinjam" {{ old('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ old('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="Terlambat" {{ old('status') == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Tombol Simpan dan Batal -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>

                            <a href="{{ auth()->user()->hasRole('admin') ? route('loans.index') : route('user.loans') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app3-layout>
