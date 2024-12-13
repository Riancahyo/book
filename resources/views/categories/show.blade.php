<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kategori') }}
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

                        <div>
                            <x-input-label value="ID Kategori" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->id }}
                            </p>
                        </div>

                        <div>
                            <x-input-label value="Nama Kategori" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->name }}
                            </p>
                        </div>

                        <div>
                            <x-input-label value="Deskripsi" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 min-h-[100px]">
                                {{ $category->description }}
                            </p>
                        </div>

                        <div>
                            <x-input-label value="Dibuat Pada" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->created_at }}
                            </p>
                        </div>

                        <div>
                            <x-input-label value="Diperbarui Pada" />
                            <p class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $category->updated_at }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Edit') }}
                            </a>

                            <a href="{{ route('categories.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Kembali') }}
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
