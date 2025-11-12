<?php

namespace App\Events;

use App\Models\Reminder;
use Illuminate\Queue\SerializesModels;

class ReminderSaved
{
    use SerializesModels;

    public $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }
}
