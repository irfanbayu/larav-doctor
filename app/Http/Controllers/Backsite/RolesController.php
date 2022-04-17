<?php

namespace App\Http\Controllers\Backsite;

// use library here
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Role\StoreRolesRequest;
use App\Http\Requests\Role\UpdateRolesRequest;

// use everything here
// use Gate;
use Auth;

// use model here
use App\Models\ManagementAccess\Roles;
use App\Models\ManagementAccess\RoleUsers;
use App\Models\ManagementAccess\Permissions;
use App\Models\ManagementAccess\RolePermissions;

// thirdparty package

class RolesController extends Controller
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
        $roles = Roles::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.management-access.roles.index', compact('roles'));
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
    public function store(StoreRolesRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // store to database
        $roles = Roles::create($data);

        alert()->success('Success Message', 'Successfully added new role');
        return redirect()->route('backsite.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        $roles->load('permissions');

        return view('pages.backsite.management-access.roles.show', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        $permissions = Permissions::all();
        $roles->load('permissions');

        return view('pages.backsite.management-access.roles.edit', compact('roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRolesRequest $request, Roles $roles)
    {
        $roles->update($request->all());
        $roles->permissions()->sync($request->input('permissions', []));

        alert()->success('Success Message', 'Successfully updated role');
        return redirect()->route('backsite.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        $roles->forceDelete();

        alert()->success('Success Message','Successfully deleted role');
        return back();
    }
}
