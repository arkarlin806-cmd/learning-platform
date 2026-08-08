<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'role',
        'email_schedule_notification',
        'current_streak',
        'last_login_date',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
    public function single_course() //single course show instructor
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
    public function purchases()
    {
        return $this->hasMany(CourseOrder::class);
    }
    public function liveParticipations()
    {
        return $this->hasMany(CourseLiveParticipant::class);
    }

    public function wallet()
    {
        return $this->hasOne(InstructorWallet::class);
    }
    public function courseOrders()
    {
        return $this->hasMany(CourseOrder::class, 'instructor_id');
    }
}
