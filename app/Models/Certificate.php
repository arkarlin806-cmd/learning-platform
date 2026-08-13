<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Certificate extends Model
{

    use HasFactory;



    protected $fillable = [

        // Relations
        'user_id',
        'course_id',
        'instructor_id',
        'certificate_frame_id',


        // Identity
        'certificate_id',
        'verification_hash',


        // QR
        'qr_code',


        // Instructor Content
        'description',
        'signature',


        // Status
        'status',
        'issued_at',

    ];




    protected $casts = [

        'issued_at' => 'datetime',

    ];




    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */


    // Learner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }




    // Instructor
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }





    // Frame Template
    public function frame()
    {
        return $this->belongsTo(
            CertificateFrame::class,
            'certificate_frame_id'
        );
    }
}
