<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'priority',
        'status_id',
        'user_id',
        'attachment',
        'submission_date',
        'resolution_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Scope for filtering complaints by status, priority, and category
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['status'])) {
            $query->where('status_id', $filters['status']);
        }

        if (isset($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (isset($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        return $query;
    }

    // Accessor to calculate the resolution time in days
    public function getResolutionTimeAttribute()
    {
        if ($this->resolution_date && $this->submission_date) {
            return $this->resolution_date->diffInDays($this->submission_date);
        }
        return null;
    }

}
