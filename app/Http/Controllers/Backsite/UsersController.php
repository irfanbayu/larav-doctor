<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;


// use library here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\StoreUsersRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UpdateUsersRequest;
// use everything here
// use Gate;
use Auth;

// use model here
use App\Models\User;
use App\Models\ManagementAccess\DetailUsers;
use App\Models\ManagementAccess\Permissions;
use App\Models\ManagementAccess\Roles;
use App\Models\MasterData\TypeUsers;

// thirdparty package

class UsersController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $type_users = TypeUsers::orderBy('name', 'asc')->get();
        $roles = Roles::all()->pluck('title', 'id');

        return view('pages.backsite.management-access.user.index', compact('users', 'roles', 'type_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersRequest $request_user, Request $request)
    {
        // get all request from frontsite
        $data = $request_user->all();

        // hash password
        $data['password'] = Hash::make($data['password']);

        // store to database
        $user = User::create($data);

        // sync role by user select
        $user->roles()->sync($request_user->input('roles', []));

        // save to detail user, to set type user
        $detail_user = new DetailUsers;
        $detail_user->users_id = $user->id;
        $detail_user->type_users_id = $request['type_users_id'];
        $detail_user->save();

        alert()->success('Success Message', 'Successfully added new user');
        return redirect()->route('backsite.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles');

        return view('pages.backsite.management-access.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Roles::all()->pluck('title', 'id');
        $type_users = TypeUsers::orderBy('name', 'asc')->get();
        $user->load('roles');

        return view('pages.backsite.management-access.user.edit', compact('user', 'roles', 'type_users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request_user, Request $request, User $user)
    {
        // get all request from frontsite
        $data = $request_user->all();

        // update to database
        $user->update($data);

        // update roles
        $user->roles()->sync($request_user->input('roles', []));

        // save to detail user , to set type user
        $detail_user = DetailUsers::find($user['id']);
        $detail_user->type_users_id = $request['type_users_id'];
        $detail_user->save();

        alert()->success('Success Message', 'Successfully updated user');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->forceDelete();

        alert()->success('Success Message', 'Successfully deleted user');
        return back();
    }
}
