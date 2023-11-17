<?php

namespace App\Http\Controllers\Admin;

use App\Models\users;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreusersRequest;
use App\Http\Requests\UpdateusersRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected UserRepositoryInterface $userRepository;
    /**
     * Display a listing of the resource.
     */

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $q = "";
        if ($request->has('q')) {
            $q = $request->q;
            if ($q == "") {
                $users = $this->userRepository->all(3);
            } else {
                $users = $this->userRepository->searchUsersByAttribute(3, $q, "fullName");
            }
        } else {
            $users = $this->userRepository->all(3);
        }
        return view('admin.users.index', compact(['users', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreusersRequest $request)
    {
        //
        // return view('profile');
    }

    /**
     * Display the specified resource.
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateusersRequest $request, users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(users $users)
    {
        //
    }
}
