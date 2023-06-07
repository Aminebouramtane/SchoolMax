<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';

    public function getEvent()
    {
        $events = Event::select('id', 'title', 'start')->get();

        return json_encode($events);
    }

    public function deleteEvent($eventId)
    {
        $event = Event::find($eventId);
        if ($event) {
            $event->delete();
        }
    }

    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
    }

    public function eventDrop($event, $oldEvent)
    {
        if (isset($event['id'])) {
            $eventData = Event::find($event['id']);
            if ($eventData) {
                $eventData->start = $event['start'];
                $eventData->save();
            }
        }
    }

    public function render()
    {
        $events = Event::select('id', 'title', 'start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}
