<?php

namespace App\Services;

use App\Model\City;
use App\Model\School;

class SchoolService
{

    public function loadAll()
    {
       return School::all();
    }

    public function load($id)
    {
        return School::with('city')->findOrFail($id);
    }

    public function findOther($id, $name)
    {
        return School::where('name', $name)->where('id', '<>', $id)->first();
    }

    public function searchSchools($name, $city)
    {
         return School::with('city')
             ->where('name', 'like', '%'.$name.'%')
             ->get()

             ->where('city.name',$city)
             ->map(function ($item) {
                 return $item->name;
             })
         ;
    }

    public function add($data)
    {
        $school = new School();
        $school->name = $data['name'];
        $school->city()->associate(City::firstOrCreate(['name' => $data['city']['name']]));
        $school->save();
    }

    public function update(School $school, $data)
    {
        $school->name = $data['name'];
        $school->city()->associate(City::firstOrCreate(['name' => $data['city']['name']]));

        $school->save();
    }

    public function remove($id)
    {
        $school = $this->load($id);
        $school->delete();
    }

    public function findOrCreateSchool($name, City $city)
    {
        $school = School::where('name', $name)
            ->where('city_id', $city->id)
            ->first();

        if (!$school) {
            $school = new School();
            $school->name = $name;
            $school->city()->associate($city);
            $school->save();
        }

        return $school;
    }

}