<?php

namespace App\Listeners;

use App\Events\ImageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApplyImageStatus
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(ImageCreated $event): void
    {
        //
    }
}
