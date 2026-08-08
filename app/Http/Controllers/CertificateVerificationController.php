<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Certificate;



class CertificateVerificationController extends Controller
{


    public function verify($hash)
    {


        $certificate =
            Certificate::with([
                'user',
                'course',
                'instructor',
                'frame'
            ])
            ->where(
                'verification_hash',
                $hash
            )
            ->first();




        if (!$certificate) {

            return view(
                'certificates.invalid'
            );
        }





        return view(
            'certificates.verify',
            compact(
                'certificate'
            )
        );
    }
}
