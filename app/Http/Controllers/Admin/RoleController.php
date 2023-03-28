<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Role\RoleServiceInterface;
use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;
    public function __construct(RoleServiceInterface $roleService, PermissionServiceInterface $permissionRepository) {
        $this->middleware('auth:admin');
        $this->roleService = $roleService;
        $this->permissionRepository = $permissionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->getAll();
        return view('admin.roles.index', compact('roles'));
    }

    public function indexWithDeleted() {
        $roles = $this->roleService->getAllWithDeleted();
        return view('admin.roles.indexWithDeleted', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $role = $this->roleService->create($request->all());
        if($role) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Thêm mới thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Thêm mới thát bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleService->getById($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleService->update($id, $request->all());
        if($role) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Update thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Update thát bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->roleService->delete($id);
        if($role) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Delete thất bại');
        }
    }

    public function forceDelete($id) {
        $role = $this->roleService->deleteForever($id);
        if($role) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Forever Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Forever Delete thất bại');
        }
    }

    public function restore($id) {
        $role = $this->roleService->restoreDeleted($id);
        if($role) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Delete thất bại');
        }
    }

    public function editPermission($id) {
        $role = $this->roleService->getById($id);
        $permissions = $this->permissionRepository->getAll();
        return view('admin.roles.editPermission', compact('role', 'permissions'));
    }

    public function updatePermission(Request $request) {
        $newPermission = explode(',',$request->input('newPermission'));
        $id = $request->input('id');
        $role = $this->roleService->getById($id);
        $result = $role->permissions()->sync($newPermission);
        if($result) {
            return redirect(route('admin.roles.index'))->with('alert-success', 'Edit Permission thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Edit Permission thất bại');
        }
    }

}
