<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model // Model untuk tabel 'lists'
{
    use HasFactory;

    protected $table = 'lists'; // Eksplisit mendefinisikan nama tabel

    protected $fillable = [
        'user_id',
        'title',
    ];

    /**
     * Get the user that owns the list.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tasks for the list.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id'); // Foreign key di tabel tasks adalah 'list_id'
    }
}