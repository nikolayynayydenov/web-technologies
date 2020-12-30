<?php

namespace App\Controllers;

use App\Models\Event;
use Core\Exceptions\NotFoundException;

class EventsController
{
    public function create()
    {
        view('events/create');
    }
    
    public function store()
    {
        //
    }
}
