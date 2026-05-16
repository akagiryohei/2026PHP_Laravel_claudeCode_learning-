<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'is_completed', 'category_id', 'due_date', 'priority'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
