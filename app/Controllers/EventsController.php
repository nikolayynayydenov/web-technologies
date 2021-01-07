<?php

namespace App\Controllers;

use App\Models\Event;
use App\Models\Teacher;
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

    public function show($id)
    {
        $event = Event::getById($id);

        if ($event) {
            view('/events/show', [
                'event' => $event
            ]);
        } else {
            response('Event not found', 404);
        }
    }

    public function import($id)
    {
        $event = Event::getById($id);

        if ($event) {
            // TODO: import
            redirect("/event/$id");
        } else {
            response('Event not found', 404);
        }
    }
}
