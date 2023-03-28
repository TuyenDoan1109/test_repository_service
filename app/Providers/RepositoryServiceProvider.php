<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Category\CategoryService;

use App\Repositories\Subcategory\SubcategoryRepositoryInterface;
use App\Repositories\Subcategory\SubcategoryRepository;
use App\Services\Subcategory\SubcategoryServiceInterface;
use App\Services\Subcategory\SubcategoryService;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Admin\AdminRepository;
use App\Services\Admin\AdminServiceInterface;
use App\Services\Admin\AdminService;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductService;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Services\Role\RoleServiceInterface;
use App\Services\Role\RoleService;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Permission\PermissionService;

use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Post\PostRepository;
use App\Services\Post\PostServiceInterface;
use App\Services\Post\PostService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Category
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->singleton(
            CategoryServiceInterface::class,
            CategoryService::class
        );

        // Subcategory
        $this->app->singleton(
            SubcategoryRepositoryInterface::class,
            SubcategoryRepository::class
        );
        $this->app->singleton(
            SubcategoryServiceInterface::class,
            SubcategoryService::class
        );

        // Admin
        $this->app->singleton(
            AdminRepositoryInterface::class,
            AdminRepository::class
        );
        $this->app->singleton(
            AdminServiceInterface::class,
            AdminService::class
        );

        // Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        // Role
        $this->app->singleton(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );
        $this->app->singleton(
            RoleServiceInterface::class,
            RoleService::class
        );

        // Permission
        $this->app->singleton(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );
        $this->app->singleton(
            PermissionServiceInterface::class,
            PermissionService::class
        );

        // Post
        $this->app->singleton(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        $this->app->singleton(
            PostServiceInterface::class,
            PostService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
