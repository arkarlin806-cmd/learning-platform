<?php

namespace App\Http\Middleware;

use App\Models\CourseLiveSession;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnsureCourseLiveAccess
{
    public function handle(Request $request, Closure $next)
    {
        $session = $request->route('session');

        if (!$session instanceof CourseLiveSession) {
            $session = CourseLiveSession::query()->findOrFail($session);
        }

        $user = $request->user();
        $course = $session->course;

        $isInstructor = (int) $course->instructor_id === (int) $user->id;

        $isEnrolled = DB::table('course_orders')
            ->where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->whereIn('status', ['paid'])
            ->exists();

        if (!$isInstructor && !$isEnrolled) {
            abort(403, 'You are not allowed to join this live class.');
        }

        return $next($request);
    }
}
