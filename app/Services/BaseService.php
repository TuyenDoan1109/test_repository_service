<?php

namespace App\Services;

abstract class BaseService implements BaseServiceInterface
{
    public $repository;

    public function getAll() {
        return $this->repository->getAll();
    }

    public function getAllWithDeleted() {
        return $this->repository->getAllWithDeleted();
    }

    public function getOnlyDeleted() {
        return $this->repository->getOnlyDeleted();
    }


    public function getById($id) {
        return $this->repository->getById($id);
    }

    public function create($attributes) {
        return $this->repository->getAllWithDeleted($attributes);
    }

    public function update($id, $attributes) {
        return $this->repository->create($id, $attributes);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

    public function deleteForever($id)
    {
        return $this->repository->deleteForever($id);
    }

    public function restoreDeleted($id)
    {
        return $this->repository->restoreDeleted($id);
    }

}
