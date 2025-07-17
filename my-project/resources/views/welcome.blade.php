<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Posts</title>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <div class="max-w-4xl mx-auto bg-white shadow-md p-6 rounded-lg p-10">
        <h1 class="text-2xl font-bold mb-6">Add New Post</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST" class="space-y-4 mb-8">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="title" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Content</label>
                <textarea name="content" rows="4" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </form>

        <h2 class="text-xl font-semibold mb-4">All Posts</h2>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">Konten</th>
                    <th class="py-2 px-4 border-b">Slug</th>
                    <th class="py-2 px-4 border-b">Kategori</th>
                    <th class="py-2 px-4 border-b">Status Publish</th>
                    <th class="py-2 px-4 border-b">Tanggal Publish</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->content }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->slug }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->category->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->is_publish }}</td>
                        <td class="py-2 px-4 border-b">{{ $article->published_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Cateogries --}}
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
    </button>

   

       

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script>
</body>
</html>
