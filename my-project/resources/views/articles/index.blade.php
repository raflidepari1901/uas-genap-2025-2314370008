@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <h1 class="mb-4">Daftar Artikel</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addArticleModal">
        Tambah Artikel
    </button>

    <!-- Tabel Artikel -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Konten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->category->name ?? '-' }}</td>
                    <td>
                        @if($article->is_publish)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>
                    <td>
                        {{ \Illuminate\Support\Str::limit($article->content ?? '-', 50, '...') }}
                    </td>
                    <td>
                        <!-- Edit -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $article->id }}">
                            Edit
                        </button>

                        <!-- Delete -->
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Artikel -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('articles.store') }}" class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="addArticleModalLabel">Tambah Artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Isi Konten</label>
                        <textarea name="content" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_publish" value="1">
                        <label class="form-check-label">Publikasikan</label>
                    </div>
                    <div class="mb-3">
                        <label>Waktu Publish</label>
                        <input type="datetime-local" name="published_at" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah Artikel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Artikel - DI LUAR TABLE -->
    @foreach ($articles as $article)
        <div class="modal fade" id="editModal{{ $article->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $article->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('articles.update', $article->id) }}" class="modal-content">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $article->id }}">Edit Artikel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $article->slug }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $article->category_id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Isi Konten</label>
                            <textarea name="content" class="form-control" rows="4" required>{{ $article->content }}</textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_publish" value="1" {{ $article->is_publish ? 'checked' : '' }}>
                            <label class="form-check-label">Publikasikan</label>
                        </div>
                        <div class="mb-3">
                            <label>Waktu Publish</label>
                            <input type="datetime-local" name="published_at" class="form-control"
                                   value="{{ $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d\TH:i') : '' }}">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
