@extends('layouts.main')

@section('content')
    <div class="container mb-5">
        <h1 class="text-center mb-4">Edit Buku</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" class="p-4 bg-light rounded shadow" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="form-group">
                <label for="user_id" class="font-weight-bold">User ID</label>
                <input type="text" name="user_id" class="form-control" value="{{ old('user_id', $book->user_id) }}" required>
            </div>

            <div class="form-group">
                <label for="title" class="font-weight-bold">Judul</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group">
                <label for="author" class="font-weight-bold">Penulis</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="form-group">
                <label for="description" class="font-weight-bold">Deskripsi</label>
                <textarea name="description" class="form-control" required>{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status" class="font-weight-bold">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Tersedia" {{ $book->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Tidak_Tersedia" {{ $book->status == 'Tidak_Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="category_id" class="font-weight-bold">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="gdrive_link" class="font-weight-bold">Google Drive Link</label>
                <input type="url" name="gdrive_link" class="form-control" placeholder="https://drive.google.com/..." value="{{ old('gdrive_link', $book->gdrive_link) }}">
            </div>

            <div class="form-group">
                <label for="image" class="font-weight-bold">Gambar Buku</label>
                <input type="file" name="image" class="form-control">
                
                @if ($book->image)
                    <div class="mt-2">
                        <p><strong>Gambar Saat Ini:</strong></p>
                        <img src="{{ asset('storage/' . $book->image) }}" alt="Current Book Image" class="img-thumbnail" width="150">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success mb-3 mt-2">Perbarui Buku</button>
        </form>
    </div>
@endsection
