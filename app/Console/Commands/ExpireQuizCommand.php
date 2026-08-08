<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quiz;

class ExpireQuizCommand extends Command
{
    protected $signature = 'quiz:expire';

    protected $description = 'Auto expire quizzes';

    public function handle()
    {
        Quiz::where('status', 'draft')
            ->where('end_at', '<=', now())
            ->update([
                'status' => 'expired'
            ]);

        $this->info('Quiz expired successfully');
    }
}
