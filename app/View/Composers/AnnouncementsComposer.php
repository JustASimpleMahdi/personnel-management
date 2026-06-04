<?php

namespace App\View\Composers;

use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementsComposer
{
    /**
     * Create a new class instance.
     */
    public function compose(View $view): void
    {
        $view->with('announcements', Announcement::latest()->get());
    }
}
