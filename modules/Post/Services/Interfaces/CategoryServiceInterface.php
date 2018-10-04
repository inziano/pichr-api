<?php

namespace Modules\Category\Services\Interfaces;

interface CategoryServiceInterface {

    // Methods
    public function createSingleCategory($request);

    public function updateSingleCategory($request,$id);

    public function getAllCategories();

    public function getSingleCategory($id);

    public function deleteCategory($id);
}