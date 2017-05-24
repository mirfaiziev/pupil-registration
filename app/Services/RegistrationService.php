<?php

namespace App\Services;

use App\Model\City;
use App\Model\Event;
use App\Model\Pupil;
use App\Model\School;
use App\Model\SuggestName;
use Illuminate\Http\Request;

class RegistrationService
{
    public function register($data)
    {
        // check name
        $firstName = ucfirst(trim($data['first_name']));
        $this->addFirstNameIfNotExists($firstName);

        // check city
        $city = City::firstOrCreate(['name' => $data['city']]);
        //check school
        $school = School::firstOrCreate([
            'name' => $data['school'],
            'city_id' => $city->id,
        ]);

        $pupil = new Pupil();
        $pupil->first_name = $data['first_name'];
        $pupil->family_name = $data['family_name'];
        $pupil->class = $data['class'];
        $pupil->teacher = $data['teacher'];
        $pupil->email = $data['email'];
        $pupil->phone = $data['phone'];

        $pupil->ip = $data['ip'];

        $pupil->school()->associate($school);
        $pupil->save();

        // attach events
        foreach ($data['event'] as $id => $status) {
            $pupil->events()->attach(Event::findOrFail($id)->id);
        }
    }

    public function searchCities($name)
    {
        return City::where('name', 'like', '%'.$name.'%')->get()->map(function($item) {
            return $item->name;
        });
    }

    protected function addFirstNameIfNotExists($firstName)
    {
        $name = SuggestName::where('name', $firstName)->first();
        if (!$name) {
            $suggestName = new SuggestName();
            $suggestName->name = $firstName;
            $suggestName->save();
        }
    }

}
