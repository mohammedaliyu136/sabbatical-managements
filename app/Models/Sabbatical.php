<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sabbatical extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'destination',
        'purpose',
        'start_date',
        'end_date',
        'update_frequency',
        'status',
        'approval_status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'approved_at' => 'datetime',
        ];
    }

    /**
     * Get the doctor that owns the sabbatical.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the progress reports for this sabbatical.
     */
    public function progressReports(): HasMany
    {
        return $this->hasMany(ProgressReport::class);
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'upcoming' => 'blue',
            'active' => 'green',
            'completed' => 'gray',
            default => 'gray'
        };
    }

    /**
     * Get the duration of the sabbatical in days.
     */
    public function getDurationAttribute(): int
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Check if sabbatical is currently active.
     */
    public function isActive(): bool
    {
        $today = now()->startOfDay();
        return $this->start_date <= $today && $this->end_date >= $today;
    }

    /**
     * Check if sabbatical is upcoming.
     */
    public function isUpcoming(): bool
    {
        return $this->start_date > now()->startOfDay();
    }

    /**
     * Check if sabbatical is completed.
     */
    public function isCompleted(): bool
    {
        return $this->end_date < now()->startOfDay();
    }

    /**
     * Scope to get active sabbaticals.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get upcoming sabbaticals.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }

    /**
     * Scope to get completed sabbaticals.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Get the approver that approved the sabbatical.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if sabbatical is pending approval.
     */
    public function isPending(): bool
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if sabbatical is approved.
     */
    public function isApproved(): bool
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if sabbatical is rejected.
     */
    public function isRejected(): bool
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Approve the sabbatical.
     */
    public function approve(int $approverId): void
    {
        $this->update([
            'approval_status' => 'approved',
            'approved_by' => $approverId,
            'approved_at' => now(),
        ]);
    }

    /**
     * Reject the sabbatical.
     */
    public function reject(int $approverId, string $reason): void
    {
        $this->update([
            'approval_status' => 'rejected',
            'approved_by' => $approverId,
            'approved_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }

    /**
     * Update status based on current date and approval status.
     */
    public function updateStatus(): void
    {
        // Only update status if sabbatical is approved
        if ($this->approval_status !== 'approved') {
            return;
        }

        $today = now()->startOfDay();
        
        if ($this->start_date <= $today && $this->end_date >= $today) {
            $this->status = 'active';
        } elseif ($this->end_date < $today) {
            $this->status = 'completed';
        } else {
            $this->status = 'upcoming';
        }
        
        $this->save();
    }
} 