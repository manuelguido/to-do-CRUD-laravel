<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TodoItem extends Model
{
    use HasFactory;

    /**
     * Attributes
     */
    protected $table = 'todo_items';

    protected $primaryKey = 'id';

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_finished',
    ];

    /**
     * Get the user that owns the to do.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
