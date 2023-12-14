<?php

namespace App\Listeners;

use App\Events\UserLog;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLog $event): void
    {
        $userId = auth()->id() ?? null;

        Log::create([
            'user_id' => $userId,
            'log_entry' => $event->log_entry
        ]);
    }
}
