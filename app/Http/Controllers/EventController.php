<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @var EventService
     */
    protected $eventService;

    /**
     * EventController constructor.
     */
    public function __construct()
    {
        $this->eventService = app(EventService::class);
    }

    public function index()
    {
        return view('event.index',[
            'events' => $this->eventService->loadAll()
        ]);
    }

    public function showAddForm()
    {
        return view('event.form');
    }

    public function showEditForm($id)
    {
        return view('event.form', [
            'id' => $id,
            'form' => $this->eventService->load($id)
        ]);
    }

    public function add(Request $request)
    {
        $validator = $this->getValidationFactory()->make(
            $request->input(),
            [
                'name'  => 'required|unique:events',
            ]
        );

        if ($validator->fails()) {
            return view(
                'event.form',
                [
                    'form' => $request->input(),
                ]
            )->withErrors($validator);
        }

        $this->eventService->add($request->input());

        return redirect()->route('event-list');
    }

    public function edit(Request $request, $id)
    {
        $event = $this->eventService->load($id);
        if (!$event) {
            return redirect('404');
        }

        $validator = $this->getValidationFactory()->make(
            $request->all(),
            [
                'name'  => 'required',
            ]
        );

        $validator->after(function ($validator) use ($id, $request) {
            if ($this->eventService->findOther($id, $request->input('name'))) {
                $validator->errors()->add('name', 'Такое название уже есть');
            }
        });

        if ($validator->fails()) {
            return view(
                'event.form',
                [
                    'form' => $request->input(),
                ]
            )->withErrors($validator);
        }

        $this->eventService->update($event, $request->input());

        return redirect()->route('event-list');
    }

    public function remove($id)
    {
        try {
            $this->eventService->remove($id);
            return response()->json(
                [], 200
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [], 404
            );
        }
    }
}