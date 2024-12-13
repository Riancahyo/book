<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

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

                        <div>
                            <x-input-label for="user_id" value="User ID" />
                            <x-text-input 
                                id="user_id" 
                                name="user_id" 
                                type="number" 
                                class="mt-1 block w-full" 
                                value="{{ old('user_id', $loan->user_id) }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="book_id" value="Buku" />
                            <x-text-input 
                                id="book_id" 
                                name="book_id" 
                                type="number" 
                                class="mt-1 block w-full" 
                                value="{{ old('book_id', $loan->book_id) }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('book_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="loan_date" value="Tanggal Pinjam" />
                            <x-text-input 
                                id="loan_date" 
                                name="loan_date" 
                                type="date" 
                                class="mt-1 block w-full" 
                                value="{{ old('loan_date', $loan->loan_date ? $loan->loan_date->format('Y-m-d') : '') }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('loan_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="due_date" value="Tenggat Waktu" />
                            <x-text-input 
                                id="due_date" 
                                name="due_date" 
                                type="date" 
                                class="mt-1 block w-full" 
                                value="{{ old('due_date', $loan->due_date ? $loan->due_date->format('Y-m-d') : '') }}" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select 
                                id="status" 
                                name="status" 
                                class="mt-1 block w-full"
                                required
                            >
                                <option value="Dipinjam" {{ old('status', $loan->status) == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="Dikembalikan" {{ old('status', $loan->status) == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="Terlambat" {{ old('status', $loan->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Perbarui') }}
                            </x-primary-button>

                            <a href="{{ route('loans.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
