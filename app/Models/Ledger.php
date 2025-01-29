<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, string>
     */
    protected $fillable = [
        'teacher_id',
        'month',
        'total_lessons',
        'total_amount',
        'status',
        'paid_on',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'paid_on' => 'date',
    ];

    /**
     * Get the teacher associated with the ledger.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Scope a query to only include ledgers of a given month.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $month
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfMonth($query, $month)
    {
        return $query->where('month', $month);
    }

    /**
     * Scope a query to only include unpaid ledgers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }
}
