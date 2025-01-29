<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Log;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      
        'schedule_date',
        'day_of_week',
        'start_time',
        'end_time',
        'is_recurring',
        'status',
        'mentee_id',
        'meeting_url'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($classSchedule) {
            if ($classSchedule->wasChanged('status') && $classSchedule->status == 'booked') {
                $mentor = $classSchedule->mentor;
                $mentee = $classSchedule->mentee;

                Log::info('Booking status changed:', [
                    'class_id' => $classSchedule->id,
                    'mentor_id' => $mentor ? $mentor->id : null,
                    'mentee_id' => $mentee ? $mentee->id : null
                ]);

                if ($mentor && $mentee) {
                    Mail::to($mentor->email)->send(new BookingConfirmation(
                        $classSchedule,
                        $mentor,
                        $mentee,
                        true
                    ));
                    
                    Mail::to($mentee->email)->send(new BookingConfirmation(
                        $classSchedule,
                        $mentor,
                        $mentee,
                        false
                    ));
                } else {
                    Log::warning('Missing mentor or mentee:', [
                        'class_id' => $classSchedule->id,
                        'has_mentor' => (bool)$mentor,
                        'has_mentee' => (bool)$mentee
                    ]);
                }
            }
        });
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
