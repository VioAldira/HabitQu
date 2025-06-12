
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Daftar Tugas</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Tugas Baru
    </a>
</div>

@if($tasks->isEmpty())
    <div class="alert alert-info text-center">
        Belum ada tugas. Silakan tambahkan tugas baru!
    </div>
@else
    <div class="card card-custom">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            <th scope="col" style="width: 35%;">Tugas</th>
                            <th scope="col" style="width: 20%;">Tanggal</th>
                            <th scope="col" style="width: 20%;">Status</th>
                            <th scope="col" style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="task-title-link fw-bold">
                                    {{ $task->title }}
                                </a>
                                @if($task->description)
                                <p class="text-muted small mb-0">{{ Str::limit($task->description, 50) }}</p>
                                @endif
                            </td>
                            <td>{{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}</td>
                            <td>
                                @if($task->is_completed)
                                    <span class="badge bg-success status-badge"><i class="bi bi-check-circle-fill me-1"></i> Selesai</span>
                                @else
                                    <span class="badge bg-warning text-dark status-badge"><i class="bi bi-hourglass-split me-1"></i> Belum Selesai</span>
                                @endif
                            </td>
                            <td class="text-center action-buttons">
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                   <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
