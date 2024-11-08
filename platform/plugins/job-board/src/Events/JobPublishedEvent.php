<?php

namespace Botble\JobBoard\Events;

use Botble\Base\Events\Event;
use Botble\JobBoard\Models\Job;
use Illuminate\Queue\SerializesModels;

class JobPublishedEvent extends Event
{
    use SerializesModels;

    public Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
