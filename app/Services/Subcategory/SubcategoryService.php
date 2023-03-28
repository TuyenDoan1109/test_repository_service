<?php

namespace App\Services\Subcategory;

use App\Repositories\Subcategory\SubcategoryRepositoryInterface;
use App\Services\BaseService;

class SubcategoryService extends BaseService implements SubcategoryServiceInterface
{
    public function __construct(SubcategoryRepositoryInterface $subcategoryRepository) {
        $this->repository = $subcategoryRepository;
    }
}



