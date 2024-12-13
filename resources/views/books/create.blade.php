@extends('layouts.main')

@section('title', 'Buat Buku Baru')

@section('content')
    <div class="container mt-2 mb-5">
        <h1 class="text-center mb-4">Buat Buku Baru</h1>
        <form action="{{ route('books.store') }}" method="POST" class="p-4 bg-light rounded shadow" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id" class="font-weight-bold">User ID</label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="title" class="font-weight-bold">Judul</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="author" class="font-weight-bold">Penulis</label>
                <input type="text" name="author" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description" class="font-weight-bold">Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="status" class="font-weight-bold">Status</label>
                <select name="status" class="form-control">
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak_Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id" class="font-weight-bold">Kategori</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="" selected>Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="gdrive_link" class="font-weight-bold">Google Drive Link</label>
                <input type="url" name="gdrive_link" class="form-control" placeholder="https://drive.google.com/...">
            </div>
            <div class="form-group">
                <label for="image" class="font-weight-bold">Gambar Buku</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-4">Simpan</button>
        </form>
    </div>
@endsection
