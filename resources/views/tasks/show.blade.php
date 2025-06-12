
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-custom">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <h2 class="mb-0">{{ $task->title }}</h2>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit Tugas
                </a>
            </div>
            <div class="card-body p-4">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Status:</strong></div>
                    <div class="col-md-9">
                        @if($task->is_completed)
                            <span class="badge bg-success status-badge fs-6"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>
                        @else
                            <span class="badge bg-warning text-dark status-badge fs-6"><i class="bi bi-hourglass-split me-1"></i> Belum Selesai</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Deadline:</strong></div>
                    <div class="col-md-9">{{ $task->due_date ? $task->due_date->format('d F Y') : 'Tidak ada deadline' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Dibuat oleh:</strong></div>
                    <div class="col-md-9">{{ $task->list->user->name ?? 'N/A' }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3"><strong>Tanggal dibuat:</strong></div>
                    <div class="col-md-9">{{ $task->created_at->format('d F Y, H:i') }}</div>
                </div>

                @if($task->description)
                <div class="row">
                    <div class="col-md-3"><strong>Deskripsi:</strong></div>
                    <div class="col-md-9">
                        <p style="white-space: pre-wrap;">{{ $task->description }}</p>
                    </div>
                </div>
                @endif

                <hr>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tugas
                    </a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                            <i class="bi bi-trash"></i> Hapus Tugas Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection