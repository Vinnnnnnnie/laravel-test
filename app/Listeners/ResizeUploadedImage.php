<?php

namespace App\Listeners;

use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Intervention\Image\Facades\Image;

class ResizeUploadedImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ImageWasUploaded $event): void
    {
        $path = $event->path();
        $image = Image::make($path);
        if ($image->width() < 1000)
        {
            return;
        }

        $image->fit(400,400)->save($path);
        
    }
}
