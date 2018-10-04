<?php

namespace Modules\Post\Repositories\Interfaces;

interface CategoryRepositoryInterface {

    // Methods
    public function createSingleCategory($request);

    public function updateSingleCategory($request,$id);

    public function getAllCategories();

    public function getSingleCategory($id);

    public function deleteCategory($id);
}