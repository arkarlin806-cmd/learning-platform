<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseLiveController;
use App\Http\Controllers\AiImageController;
use App\Http\Controllers\ObjectDetectionController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CertificateFrameController;
use App\Http\Controllers\CertificateVerificationController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home/index', [HomeController::class, 'index'])->name('home.index');



// Google Login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/request', [ProfileController::class, 'request'])->name('profile.request');
    Route::get('/profile/schedule', [ProfileController::class, 'schedule'])->name('profile.schedule');
});

//admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/chart', [AdminController::class, 'getChartData'])->name('admin.chart');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/instructors', [AdminController::class, 'instructors'])->name('admin.instructors');
    Route::get('/admin/earnings', [AdminController::class, 'earnings'])->name('admin.earnings');
    Route::get('/LS/api/user-chart-data', [AdminController::class, 'getChartData'])->name('admin.user.chart.data');
    Route::get('/admin/chart/earnings', [AdminController::class, 'earningsChart'])->name('admin.chart.earnings');
    Route::get('/admin/course/show/{id}', [AdminController::class, 'course_show'])->name('admin.course.show');
    Route::get('/admin/instructor-earnings-chart', [AdminController::class, 'instructorEarningsChart'])->name('admin.instructor.chart');
    Route::get('/course/order', [CourseController::class, 'order'])->name('course.order');
    Route::get('/instructor/show_order/{id}', [CourseController::class, 'show_order'])->name('course.show_order');
    Route::post('/instructor/orders/{id}/status', [CourseController::class, 'updateStatus'])->name('course.updateStatus');

    //instructro request show and update status
    Route::get('/instructor-requests', [AdminController::class, 'ins_request_index'])->name('instructor.requests.index');
    Route::get('/instructor-requests/{id}', [AdminController::class, 'ins_request_show'])->name('instructor.requests.show');
    Route::put('/instructor-requests/{id}', [AdminController::class, 'ins_request_updateStatus'])->name('instructor.requests.update');

    //admin withdraw request show and accept and reject
    Route::get('/withdraw', [WithdrawalController::class, 'withdraw_index'])->name('admin.withdraw.index');
    Route::post('/withdraw/approve/{id}', [WithdrawalController::class, 'withdraw_approve'])->name('admin.withdraw.approve');
    Route::post('/withdraw/reject/{id}', [WithdrawalController::class, 'withdraw_reject'])->name('admin.withdraw.reject');
    Route::get('/admin/withdraw/wallet-analytics', [WithdrawalController::class, 'walletAnalytics'])->name('admin.withdraw.wallet.analytics');

    //learner show
    Route::get('/admin/certificates/learners', [AdminController::class, 'learners'])->name('admin.certificates.learners');

    //ban
    Route::post('/admin/users/{user}/warning', [AdminController::class, 'warning'])->name('admin.users.warning');
    Route::post('/admin/users/{user}/ban', [AdminController::class, 'ban'])->name('admin.users.ban');
    Route::post('/admin/users/{user}/activate', [AdminController::class, 'activate'])->name('admin.users.activate');
});


//group chat
Route::get('/learner/chat/{course}', [GroupChatController::class, 'index'])->name('learner.chat');
Route::post('/learner/chat/{course}/send', [GroupChatController::class, 'sendMessage'])->name('learner.chat.send');
Route::post('/learner/chat/message/update/{id}', [GroupChatController::class, 'updateMessage'])->name('learner.chat.update');
Route::delete('/learner/chat/message/delete/{id}', [GroupChatController::class, 'deleteMessage'])->name('learner.chat.delete');


//instructor
Route::middleware(['auth', 'instructor'])->group(function () {

    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/instructor/course/store', [CourseController::class, 'course_store'])->name('course.course_store');

    Route::get('/instructor/index', [InstructorController::class, 'index'])->name('instructor.index');
    Route::get('/instructor/chart/{type}', [InstructorController::class, 'chart'])->name('instructor.earnings.chart');
    Route::get('/instructor/schedule', [InstructorController::class, 'schedule'])->name('instructor.schedule');
    Route::get('/instructor/earnings', [InstructorController::class, 'earnings'])->name('instructor.earnings');
    Route::get('/instructor/earnings/chart', [InstructorController::class, 'earningsChart'])->name('instructor.earningsChart');

    // lesson update and delete 
    Route::put('/lesson/{lesson}', [LessonController::class, 'update'])->name('lesson.update');
    Route::delete('/lesson/{lesson}', [LessonController::class, 'destroy'])->name('lesson.destroy');

    // quiz create and store 
    Route::get('quiz/create/{id}', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/instructor/quiz/{quiz}/learner-scores', [QuizController::class, 'learnerScores'])
        ->name('instructor.quiz.learner-scores');
    //instructor withdraw request and cancel
    Route::get('/instructor/withdraw', [WithdrawalController::class, 'index_with'])->name('instructor.withdraw');
    Route::post('/instructor/withdraw/store', [WithdrawalController::class, 'store'])->name('instructor.withdraw.store');
    Route::delete('/instructor/withdraw/cancel/{id}', [WithdrawalController::class, 'cancel'])->name('instructor.withdraw.cancel');

    //course edit
    Route::get('/instructor/course/{course}/edit', [CourseController::class, 'edit'])->name('instructor.course.edit');
    Route::put('/instructor/course/{course}', [CourseController::class, 'update'])->name('instructor.course.update');

    Route::post('/instructor/course/{course}/complete', [InstructorController::class, 'complete'])->name('instructor.course.complete');

    //instructor quiz edit 
    Route::get('/quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{id}', [QuizController::class, 'update'])->name('quiz.update');
});



// public user and learner 
Route::middleware(['auth'])->group(function () {
    //profile edit
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // instructor and learner single course show
    Route::get('/instructor/single_course/{course}', [InstructorController::class, 'single_course'])->name('instructor.single_course');
    Route::get('/instructor/learners/{id}', [InstructorController::class, 'learners'])->name('instructor.learners');

    // single learner show 
    Route::get('/instructor/course/{course}/learner/{user}', [InstructorController::class, 'show'])->name('instructor.learner.profile');

    // public course show 
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.show');
    Route::get('/category/{category}/courses', [CourseController::class, 'categoryCourses'])->name('category.courses');
    //checkout
    Route::get('/checkout/{course}', [CourseController::class, 'checkout'])->name('course.checkout');
    Route::post('/checkout/store', [CourseController::class, 'store'])->name('course.store');

    // quiz (all, single)show and submit 
    Route::get('/quiz/quiz_all/{course}', [QuizController::class, 'quiz_all'])->name('quiz.quiz_all');
    Route::get('/quiz/show/{id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');

    // course live learner join 
    // Route::get('/courses/{course}/live/{session}', [CourseLiveController::class, 'show'])->name('learner.live.show');
    Route::get('/learner/index/{course}', [CourseLiveController::class, 'learner_index'])->name('learner.index');

    //ai chat and audio 
    Route::get('/chat/index', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/sendAudio', [ChatController::class, 'sendAudio'])->name('chat.sendAudio');
    Route::get('/chat/messages', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/regenerate', [ChatController::class, 'regenerate'])->name('chat.regenerate');
    Route::get('/chat/audio/{id}', [ChatController::class, 'playAudio'])->name('chat.audio');
    Route::get('/chat/audio/{id}/download', [ChatController::class, 'downloadAudio'])->name('chat.audio.download');
    Route::delete('/chat/audio/{id}', [ChatController::class, 'destroyAudio'])->name('chat.audio.delete');

    //ai image geneartor
    Route::get('/ai-images/img', [AiImageController::class, 'img'])->name('ai-images.img');
    Route::get('/ai-images/index', [AiImageController::class, 'index'])->name('ai-images.index');
    Route::post('/ai-images/store', [AiImageController::class, 'store'])->name('ai-images.store');
    Route::get('/ai-images/{id}', [AiImageController::class, 'show']);
    Route::get('/ai-images/status/{id}', [AiImageController::class, 'status'])->name('ai-images.status');
    Route::delete('/ai-images/{id}', [AiImageController::class, 'destroy']);

    //computer vision and free course
    Route::get('/object-detection', [ObjectDetectionController::class, 'index'])->name('object-detection');
    Route::post('/object-detection/detect', [ObjectDetectionController::class, 'detect'])->name('object-detection.detect');
    Route::get('/frontend/html', [ObjectDetectionController::class, 'html'])->name('frontend.html');
    Route::get('/frontend/css', [ObjectDetectionController::class, 'css'])->name('frontend.css');
    Route::get('/frontend/tailwind', [ObjectDetectionController::class, 'tailwind'])->name('frontend.tailwind');
    Route::get('/frontend/js', [ObjectDetectionController::class, 'js'])->name('frontend.js');
    Route::post('/image-restore/send', [ObjectDetectionController::class, 'restore'])->name('image-restore.send');
    Route::post('/cv/colorize', [ObjectDetectionController::class, 'colorize'])->name('cv.colorize');
    Route::post('/gesture/start', [ObjectDetectionController::class, 'getsure'])->name('gesture.detect');
    Route::post('/computer-vision/process', [ObjectDetectionController::class, 'process'])->name('cv.process');
    Route::post('/image-restoration/process',  [ObjectDetectionController::class, 'restore_process'])->name('restore.restore_process');
    Route::post('/gray-to-rgb/process', [ObjectDetectionController::class, 'col'])->name('gray.rgb.process');


    // IT course compare and database
    Route::get('/comparison/index', [HomeController::class, 'comparison'])->name('comparison.index');
    Route::get('/sql-editor', [QueryController::class, 'index'])->name('sql-editor');
    Route::post('/execute/query', [QueryController::class, 'execute'])->name('execute.query');

    //rating course
    Route::post('/courses/{course}/rating', [CourseController::class, 'rating_store'])->name('courses.rating.store');
    Route::delete('/courses/{course}/rating', [CourseController::class, 'rating_destroy'])->name('courses.rating.destroy');
    Route::get('/courses/{course}/rating', [CourseController::class, 'rating_show'])->name('courses.rating.show');
    Route::get('/courses/{course}/rating-summary', [CourseController::class, 'rating_summary'])->name('courses.rating.summary');

    //instructor send request and public instructor show
    Route::get('/become-instructor', [HomeController::class, 'create'])->name('become-instructor');
    Route::post('/become-instructor/store', [HomeController::class, 'store'])->name('become-instructor.store');
    Route::get('/instructors/show', [HomeController::class, 'ins_index'])->name('instructors.all_ins');
    Route::get('/instructors/{instructor}', [HomeController::class, 'single_ins_show'])->name('instructors.show');


    //learner roadmap create and show
    Route::post('/learning-goal', [RoadmapController::class, 'learner_roadmap_store'])->name('learning.goal.store');
    Route::get('/my-roadmap/create', [RoadmapController::class, 'learner_roadmap_create'])->name('learning.roadmap.create');
    Route::get('/learning/roadmap', [RoadmapController::class, 'learner_roadmap_index'])->name('learner.roadmap');
    Route::post('/learning/task/{task}/complete', [RoadmapController::class, 'completeTask'])->name('learner.task.complete');
    Route::get('/learner/roadmaps', [RoadmapController::class, 'learner_all_roadmap'])->name('learner.roadmaps.index');
    Route::get('/learner/roadmaps/{goal}', [RoadmapController::class, 'learner_single_roadmap'])->name('learner.roadmaps.show');


    //email notification on off
    Route::post('/notification/toggle', [ProfileController::class, 'toggleNotification'])->middleware('auth')->name('notification.toggle');

    //learner show certificate
    Route::get('/learner/course/{course}/certificate', [CertificateFrameController::class, 'myCertificate'])->name('learner.certificate');

    //profile change
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/password/update', [ProfileController::class, 'password_update'])->name('password.update');
});


//video call system
Route::middleware(['auth'])->group(function () {

    Route::prefix('courses/{course}/live')->name('courses.live.')->group(function () {
        Route::get('/', [CourseLiveController::class, 'index'])->name('index');
        Route::get('/create', [CourseLiveController::class, 'create'])->name('create');
        Route::post('/', [CourseLiveController::class, 'store'])->name('store');

        Route::get('/{live}', [CourseLiveController::class, 'show'])->name('show');
        Route::get('/{live}/edit', [CourseLiveController::class, 'edit'])->name('edit');
        Route::put('/{live}', [CourseLiveController::class, 'update'])->name('update');
        Route::delete('/{live}', [CourseLiveController::class, 'destroy'])->name('destroy');

        Route::post('/{live}/start', [CourseLiveController::class, 'start'])->name('start');
        Route::post('/{live}/end', [CourseLiveController::class, 'end'])->name('end');

        Route::get('/{live}/join', [CourseLiveController::class, 'join'])->name('join');
        Route::get('/{live}/room', [CourseLiveController::class, 'room'])->name('room');

        Route::post('/{live}/auto-end', [CourseLiveController::class, 'autoEnd'])->name('autoEnd');


        Route::get('/{session}', [CourseLiveController::class, 'show'])->name('learner.live.show');
    });
});


// #lesson upload
// Route::middleware(['auth'])->group(function () {
//     Route::prefix('lesson')->group(function () {
//         Route::get('/lesson/create/{id}', [LessonController::class, 'create'])->name('lesson.create');
//         Route::get('/status/{id}', [LessonController::class, 'status'])->name('lesson.status');
//         Route::get('/preview/{id}/{course_id}', [LessonController::class, 'aiPreview'])->name('lesson.preview');
//         Route::post('/{id}/save-summary', [LessonController::class, 'saveSummary'])->name('lesson.save.summary');
//         Route::get('/lesson/show/{id}', [LessonController::class, 'show'])->name('lesson.show');
//         Route::post('/store', [LessonController::class, 'store'])->name('lesson.store');
//     });
// });
Route::middleware(['auth'])->group(function () {

    Route::get('/lesson/create/{id}', [LessonController::class, 'create'])
        ->name('lesson.create');

    Route::get('/lesson/status/{id}', [LessonController::class, 'status'])->name('lesson.status');

    // Route::get('/lesson/preview/{id}/{course_id}', [LessonController::class, 'aiPreview'])->name('lesson.preview');

    Route::post('/lesson/{id}/save-summary', [LessonController::class, 'saveSummary'])->name('lesson.save.summary');

    Route::get('/lesson/show/{id}', [LessonController::class, 'show'])
        ->name('lesson.show');

    Route::post('/lesson/store', [LessonController::class, 'store'])
        ->name('lesson.store');
});

Route::get(
    '/lesson/{id}/preview/{course_id}',
    [LessonController::class, 'aiPreview']
)->name('lesson.preview');
//admin roadmap 

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/roadmaps', [RoadmapController::class, 'index'])->name('admin.roadmaps.index');
        Route::get('/roadmaps/create', [RoadmapController::class, 'create'])->name('admin.roadmaps.create');
        Route::post('/roadmaps', [RoadmapController::class, 'store'])->name('admin.roadmaps.store');
        Route::get('/roadmaps/{roadmap}', [RoadmapController::class, 'show'])->name('admin.roadmaps.show');
        Route::get('/roadmaps/{roadmap}/edit', [RoadmapController::class, 'edit'])->name('admin.roadmaps.edit');
        Route::put('/roadmaps/{roadmap}', [RoadmapController::class, 'update'])->name('admin.roadmaps.update');
        Route::delete('/roadmaps/{roadmap}', [RoadmapController::class, 'destroy'])->name('admin.roadmaps.destroy');
    });
Route::get('/admin/course-search', [RoadmapController::class, 'search'])->name('admin.course.search');



//contact
Route::middleware('auth')->group(function () {


    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/inbox', [ContactController::class, 'inbox'])->name('contact.inbox');
    Route::get('/contact/read/{id}', [ContactController::class, 'read'])->name('contact.read');
    Route::post('/contact/reply', [ContactController::class, 'reply'])->name('contact.reply');
});

Route::get('/home/about', [HomeController::class, 'about'])->name('home.about');
Route::post('/courses/{course}/live/{live}/leave', [CourseLiveController::class, 'leave'])->middleware('auth')->name('courses.live.leave');


Route::get('/admin/certificate-frames', [CertificateFrameController::class, 'index'])
    ->name('admin.certificate.frames.index');
Route::prefix('admin/certificate-frames')
    ->name('admin.certificate.frames.')
    ->group(function () {

        Route::get(
            '/create',
            [CertificateFrameController::class, 'create']
        )->name('create');


        Route::post(
            '/store',
            [CertificateFrameController::class, 'store']
        )->name('store');
    });
Route::get(
    '/admin/certificate-frames/{certificateFrame}',
    [CertificateFrameController::class, 'show']
)->name(
    'admin.certificate.frames.show'
);


Route::get(
    '/instructor/certificate/create/{course}',
    [CertificateFrameController::class, 'ins_create']
)->name(
    'instructor.certificate.create'
);
Route::post(
    '/instructor/certificates/store/{course}',
    [CertificateFrameController::class, 'ins_store']
)->name('instructor.certificates.store');
Route::get(
    '/certificate/verify/{hash}',
    [CertificateVerificationController::class, 'verify']
)
    ->name('certificate.verify');

Route::middleware(['auth'])
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {


        Route::get(
            '/courses/{course}/certificates',
            [CertificateFrameController::class, 'ins_index']
        )
            ->name('certificates.index');
    });


Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/certificate-frames/{certificateFrame}/edit',
            [CertificateFrameController::class, 'edit']
        )->name('certificate-frames.edit');

        Route::put(
            '/certificate-frames/{certificateFrame}',
            [CertificateFrameController::class, 'update']
        )->name('certificate-frames.update');
    });


Route::middleware('auth')
    ->prefix('instructor')
    ->name('instructor.')
    ->group(function () {


        Route::get(
            '/certificates/{certificate}',
            [CertificateFrameController::class, 'certificate_show']
        )
            ->name('certificates.show');



        Route::get(
            '/certificates/{certificate}/pdf',
            [CertificateFrameController::class, 'downloadPdf']
        )
            ->name('certificates.pdf');
    });

Route::get(
    '/instructor/quizzes/{quiz}/edit',
    [QuizController::class, 'edit']
)->name('quiz.edit');



Route::put(
    '/instructor/quizzes/{quiz}',
    [QuizController::class, 'update']
)->name('quiz.update');


Route::delete(
    '/instructor/questions/{question}',
    [QuizController::class, 'destroyQuestion']
)->name('question.delete');

Route::get('/about', function (HomeController $aboutService) {
    $data = $aboutService->getAboutPageData();

    return view('home.about', $data);
})->name('about');



Route::get(
    '/settings/index',
    [HomeController::class, 'set_index']
)->name('settings.index');





Route::get(
    '/forgot-password',
    [ForgotPasswordController::class, 'index']
)->name('forgot.password');


Route::post(
    '/forgot-password/send-otp',
    [ForgotPasswordController::class, 'sendOtp']
)->name('forgot.sendOtp');


Route::post(
    '/forgot-password/verify-otp',
    [ForgotPasswordController::class, 'verifyOtp']
)->name('forgot.verifyOtp');


Route::post(
    '/forgot-password/reset',
    [ForgotPasswordController::class, 'resetPassword']
)->name('forgot.resetPassword');


Route::post(
    '/forgot-password/resend',
    [ForgotPasswordController::class, 'resendOtp']
)->name('forgot.resendOtp');



Route::get('/debug-scheme', function () {
    return [
        'scheme' => request()->getScheme(),
        'secure' => request()->secure(),
        'forwarded_proto' => request()->header('x-forwarded-proto'),
        'headers' => request()->headers->all(),
    ];
});


//admin and instructor certificate show production level
Route::get(
    '/admin/certificate/image/{filename}',
    [CertificateFrameController::class, 'certificateImage']
)->name('admin.certificate.image');
Route::get(
    '/instructor/certificate/{certificate}/file/{type}',
    [CertificateFrameController::class, 'certificateFile']
)->name('instructor.certificate.file');
