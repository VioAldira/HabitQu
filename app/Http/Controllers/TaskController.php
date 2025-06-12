<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Lists; // Model untuk tabel 'lists'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan user yang sedang login
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login'); // Jika belum login, redirect ke halaman login
        }

        // Dapatkan semua tasks milik user tersebut melalui lists mereka
        // Ini mengasumsikan user memiliki lists, dan tasks ada di dalam lists tersebut.
        // Kita akan mengambil semua task dari semua list milik user.
        $tasks = Task::whereHas('list', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->orderBy('due_date', 'asc')->orderBy('created_at', 'desc')->get();


        return view('todo.homepage', compact('tasks')); // Diubah dari 'tasks.homepage' ke 'todo.homepage'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Untuk create, kita tidak perlu mengirim data spesifik selain mungkin daftar list jika ada pilihan
        // Namun berdasarkan deskripsi, user langsung membuat task.
        // Kita akan asumsikan task dibuat pada list pertama milik user, atau buat list default jika belum ada.
        return view('todo.create'); // Diubah dari 'tasks.create' ke 'todo.create'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            // 'status' tidak perlu divalidasi dari form jika defaultnya 'Belum Selesai'
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat task.');
        }

        // Cek atau buat list default untuk user
        $list = $user->lists()->first();
        if (!$list) {
            $list = $user->lists()->create(['title' => 'My Tasks']); // Buat list default jika belum ada
        }

        $task = new Task();
        $task->list_id = $list->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->is_completed = $request->has('is_completed'); // Jika ada input 'is_completed' dan nilainya true
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Pastikan task yang diakses adalah milik user yang login (Authorization)
        $this->authorizeTaskAccess($task);
        return view('tasks.show', compact('task')); // Path view ini belum diminta diubah
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorizeTaskAccess($task);
        return view('tasks.edit', compact('task')); // Path view ini belum diminta diubah
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeTaskAccess($task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'is_completed' => 'sometimes|boolean', // 'sometimes' berarti hanya divalidasi jika ada di request
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        // Untuk status, jika checkbox 'is_completed' dicentang, nilainya akan 'on' atau true.
        // Jika tidak dicentang, field 'is_completed' mungkin tidak dikirim, jadi kita cek.
        $task->is_completed = $request->has('is_completed');

        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorizeTaskAccess($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus!');
    }

    /**
     * Helper method to authorize task access.
     * Memastikan task yang sedang dioperasikan adalah milik user yang login.
     */
    private function authorizeTaskAccess(Task $task)
    {
        if ($task->list->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // User tidak berhak mengakses task ini
        }
    }
}
