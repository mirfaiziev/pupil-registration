<?php

namespace App\Http\Controllers;

use App\Services\SchoolService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * @var SchoolService
     */
    protected $schoolService;

    public function __construct()
    {
        $this->schoolService = app(SchoolService::class);
    }

    public function index()
    {
        $schools = $this->schoolService->loadAll();

        return view('school.index', ['schools' => $schools]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $schools = $this->schoolService->searchSchools(
            $request->input('q'),
            $request->input('city')
        );

        return response()->json($schools);
    }

    public function showAddForm()
    {
        return view('school.form');
    }

    public function add(Request $request)
    {
        $validator = $this->getValidationFactory()->make(
            $request->all(),
            [
                'name' => 'required|unique:school',
                'city.name' => 'required'
            ]
        );

        if ($validator->fails()) {
            return view(
                'school.form',
                [
                    'form' => $request->all(),
                ]
            )->withErrors($validator);
        }

        $this->schoolService->add($request->all());

        return redirect()->route('school-list');
    }

    public function showEditForm($id)
    {
        try {
            return view(
                'school.form',
                [
                    'id'   => $id,
                    'form' => $this->schoolService->load($id)
                ]
            );
        } catch (ModelNotFoundException $e) {
            return redirect()->route('404');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $school = $this->schoolService->load($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('404');
        }

        $validator = $this->getValidationFactory()->make(
            $request->all(),
            [
                'name' => 'required',
            ]
        );

        $validator->after(
            function ($validator) use ($id, $request) {
                if ($this->schoolService->findOther($id, $request->input('name'))) {
                    $validator->errors()->add('name', 'Такое название уже есть');
                }
            }
        );

        if ($validator->fails()) {
            return view(
                'school.form',
                [
                    'form' => $request->all(),
                ]
            )->withErrors($validator);
        }

        $this->schoolService->update($school, $request->all());

        return redirect()->route('school-list');
    }

    public function remove($id)
    {
        try {
            $this->schoolService->remove($id);

            return response()->json(
                [],
                200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [],
                404
            );
        }
    }
}