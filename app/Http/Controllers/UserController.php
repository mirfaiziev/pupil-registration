<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = app(UserService::class);
    }


    public function index()
    {
        return view('user.index', ['users' => $this->userService->loadAll()]);
    }

    public function showAddForm()
    {
        return view('user.form', ['roles' => User::getAvailableRoles()]);
    }

    public function add(Request $request)
    {
        $validator = $this->getValidationFactory()->make(
            $request->input(),
            [
                'name'  => 'required|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ]
        );
        if ($validator->fails()) {
            return view(
                'user.form',
                [
                    'form' => $request->input(),
                    'roles' => User::getAvailableRoles(),
                ]
            )->withErrors($validator);
        }
        $this->userService->add($request->input());

        return redirect()->route('user-list');
    }

    public function showEditForm($id)
    {
        return view('user.form', [
            'id' => $id,
            'roles' => User::getAvailableRoles(),
            'form' => User::find($id),
        ]);
    }

    public function edit($id, Request $request)
    {


    }

}
