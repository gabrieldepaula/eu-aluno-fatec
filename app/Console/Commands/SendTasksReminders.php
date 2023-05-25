<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Console\Command;
use App\Notifications\StudentTaskReminder;

class SendTasksReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send tasks reminders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now()->addDay()->format('Y-m-d');
        $tasks = Task::whereRaw('DATE(delivery_date) = "'.$date.'"')->whereNull('done_at')->whereNull('delivered_at')->get();
        foreach($tasks as $task) {
            $task->student->notify(new StudentTaskReminder($task));
        }
        return Command::SUCCESS;
    }
}
