<?php

namespace App\Services\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\BaseService;

class RoleService extends BaseService implements RoleServiceInterface
{
    public function __construct(RoleRepositoryInterface $roleRepository) {
        $this->repository = $roleRepository;
    }
}


