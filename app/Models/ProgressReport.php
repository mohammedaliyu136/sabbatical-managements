<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sabbatical_id',
        'user_id',
        'content',
        'report_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'report_date' => 'date',
        ];
    }

    /**
     * Get the sabbatical that owns the progress report.
     */
    public function sabbatical(): BelongsTo
    {
        return $this->belongsTo(Sabbatical::class);
    }

    /**
     * Get the doctor that submitted the progress report.
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
} 