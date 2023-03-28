<?php

namespace App\Services\Admin;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Services\BaseService;

class AdminService extends BaseService implements AdminServiceInterface
{
    public function __construct(AdminRepositoryInterface $adminRepository) {
        $this->repository = $adminRepository;
    }
}



