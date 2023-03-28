<?php

namespace App\Services\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Services\BaseService;

class PermissionService extends BaseService implements PermissionServiceInterface
{
    public function __construct(PermissionRepositoryInterface $permissionRepository) {
        $this->repository = $permissionRepository;
    }
}


