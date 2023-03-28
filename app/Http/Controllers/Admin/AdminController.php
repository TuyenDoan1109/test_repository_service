<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminServiceInterface;
use App\Services\Role\RoleServiceInterface;
use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    protected $adminService;
    protected $roleService;
    protected $permissionService;
    public function __construct(AdminServiceInterface $adminService, RoleServiceInterface $roleService, PermissionServiceInterface $permissionService) {
        $this->middleware('auth:admin');
        $this->adminService = $adminService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->adminService->getAll();
        return view('admin.admins.index', compact('admins'));
    }

    public function indexWithDeleted() {
        $admins = $this->adminService->getAllWithDeleted();
        return view('admin.admins.indexWithDeleted', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ];
        $admin = $this->adminService->create($data);
        if($admin) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Thêm mới thành công');
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
        $admin = $this->adminService->getById($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateAdminRequest $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ];
        $admin = $this->adminService->update($id, $data);
        if($admin) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Update thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Update thất bại');
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
        $admin = $this->adminService->delete($id);
        if($admin) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Delete thất bại');
        }
    }

    public function forceDelete($id) {
        $admin = $this->adminService->deleteForever($id);
        if($admin) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Forever Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Forever Delete thất bại');
        }
    }

    public function restore($id) {
        $admin = $this->adminService->restoreDeleted($id);
        if($admin) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Delete thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Delete thất bại');
        }
    }

    public function editRole($id) {
        $admin = $this->adminService->getById($id);
        $roles = $this->roleService->getAll();
        return view('admin.admins.editRole', compact('admin', 'roles'));
    }

    public function updateRole(Request $request) {
        $newRole = explode(',',$request->input('newRole'));
        $id = $request->input('id');
        $admin = $this->adminService->getById($id);
        $result = $admin->roles()->sync($newRole);
        if($result) {
            return redirect(route('admin.admins.index'))->with('alert-success', 'Edit Role thành công');
        } else {
            return redirect()->back()->with('alert-error', 'Edit Role thất bại');
        }
    }

    public function editPermission($id) {
        $admin = $this->adminService->getById($id);
        $permissions = $this->permissionService->getAll();
        return view('admin.admins.editPermission', compact('admin', 'permissions'));
    }

    public function updatePermission(Request $request) {
        $newPermission = explode(',',$request->input('newPermission'));
        $id = $request->input('id');
        $admin = $this->adminService->getById($id);
        if($admin) {
            $result = $admin->permissions()->sync($newPermission);
            if($result) {
                return redirect(route('admin.admins.index'))->with('alert-success', 'Update Permission thành công');
            } else {
                return redirect()->back()->with('alert-error', 'Update Permission thất bại');
            }
        }
        return redirect(route('admin.admins.index'));
    }

}
