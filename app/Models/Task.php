<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_id',
        'title',
        'description',
        'is_completed',
        'due_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date',
    ];

    /**
     * Get the list that owns the task.
     */
    public function list() // Relasi ke model Lists
    {
        return $this->belongsTo(Lists::class, 'list_id');
    }
}