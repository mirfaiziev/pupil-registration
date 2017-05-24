<?php

namespace App\Services;

use App\Model\Event;
use Carbon\Carbon;

class EventService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function loadAll()
    {
        return Event::all();
    }

    /**
     * @param $id
     *
     * @return Event
     */
    public function load($id)
    {
        return Event::find($id);
    }

    public function findOther($id, $name)
    {
        return Event::where('name', $name)->where('id', '<>', $id)->first();
    }

    public function loadCurrents()
    {
        return Event::where('registration_start', '<=', Carbon::now())
            ->where('registration_stop', '>=', Carbon::now())->get();
    }

    public function add(array $data)
    {
        $event = new Event();
        $this->saveWithData($event, $data);
    }

    public function update(Event $event, array $data)
    {
        $this->saveWithData($event, $data);
    }

    public function remove($id)
    {
        $event = $this->load($id);
        $event->delete();
    }

    private function saveWithData(Event $event, array $data)
    {
        $event->name = $data['name'];
        $event->registration_start = $data['registration_start'];
        $event->registration_stop = $data['registration_stop'];

        $event->save();
    }
}