@extends('layouts.admin')
@section('title','Kelola Artikel')
@section('page-title','Artikel / Blog')

@section('admin-content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <p class="text-slate-500 text-sm">Total: <strong class="text-slate-800">{{ $articles->total() }}</strong> artikel</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary" style="border-radius:10px">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Artikel
    </a>
</div>

<div class="admin-table-wrapper">
    <table class="admin-table table-responsive-card">
        <thead>
            <tr><th>Thumbnail</th><th>Judul</th><th>Status</th><th>Tanggal</th><th>Views</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($articles as $article)
        <tr>
            <td data-label="Thumbnail">
                @if($article->thumbnail)
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="" style="width:60px;height:40px;object-fit:cover;border-radius:6px">
                @else
                    <div style="width:60px;height:40px;background:#f3f4f6;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1.2rem">📰</div>
                @endif
            </td>
            <td data-label="Judul">
                <strong style="display:block;font-size:.9rem">{{ Str::limit($article->title, 55) }}</strong>
                <span style="font-size:.78rem;color:#9ca3af">{{ $article->slug }}</span>
            </td>
            <td data-label="Status"><span class="{{ $article->status === 'published' ? 'status-completed' : 'status-new' }}">{{ $article->status === 'published' ? 'Terbit' : 'Draft' }}</span></td>
            <td data-label="Tanggal" style="font-size:.85rem">{{ $article->published_at?->format('d/m/Y') ?? '-' }}</td>
            <td data-label="Views">{{ number_format($article->views) }}</td>
            <td data-label="Aksi">
                <div style="display:flex;gap:.4rem;flex-wrap:wrap;justify-content:flex-end">
                    <a href="{{ route('blog.show',$article->slug) }}" class="btn-sm btn-view" target="_blank">Lihat</a>
                    <a href="{{ route('admin.articles.edit',$article) }}" class="btn-sm btn-edit">Edit</a>
                    <form action="{{ route('admin.articles.destroy',$article) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-sm btn-del">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:3rem;color:#9ca3af">Belum ada artikel.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="padding:1rem 1.25rem;border-top:1px solid #f3f4f6">{{ $articles->links() }}</div>
</div>
@endsection
