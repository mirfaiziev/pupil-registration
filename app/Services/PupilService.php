<?php

namespace App\Services;

use App\Model\SuggestName;

class PupilService
{
    /**
     * @param $query
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchNames($query)
    {
        return SuggestName::where('name', 'like', '%' . $query . '%')->get()->map(
            function ($item) {
                return $item->name;
            }
        );
    }

    public function loadForEvent($eventId)
    {
        return Event::with('pupils')->where('id', $eventId)->pupils()->get();
    }
}