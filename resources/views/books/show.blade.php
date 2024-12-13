@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">{{ $book->title }}</h1>
        
        <div class="card p-4 shadow">
            <div class="card-body">
                <h5 class="card-title">ID</h5>
                <p class="card-text">{{ $book->id }}</p>

                <h5 class="card-title">User ID</h5>
                <p class="card-text">{{ $book->user_id }}</p>

                <h5 class="card-title">Judul</h5>
                <p class="card-text">{{ $book->title }}</p>

                <h5 class="card-title">Penulis</h5>
                <p class="card-text">{{ $book->author }}</p>
                
                <h5 class="card-title">Deskripsi</h5>
                <p class="card-text">{{ $book->description }}</p>
                
                <h5 class="card-title">Status</h5>
                <p class="card-text">{{ $book->status }}</p>
                
                <h5 class="card-title">Kategori</h5>
                <p class="card-text">{{ $book->category->name ?? 'Tanpa Kategori' }}</p> <!-- Menampilkan kategori jika ada -->

                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
