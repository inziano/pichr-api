<?php

namespace Modules\Post\Repositories;

use Modules\Post\Repositories\Interfaces\CategoryRepositoryInterface;

use Modules\Post\Entities\Category;

class CategoryRepository {

    /**
     * 
     * Class constructor
     * 
     */
    public function __construct() {

    }

    /**
     * 
     * DB access methods
     * 
     */

    /**
     * 
     * Create methods
     * 
     */
    // Create single category record
    public function createSingleCategory($request) {

        $newCategory = $this->categories::create($request->all());

        return $newCategory;
    }
    /**
     * 
     * Read methods
     * 
     */
    // Query single category record 
    public function getSingleCategory($id) {

        $data = $this->categories::where('id',$id)->get();

        return $data;
    }
    // Query all category records
    public function getAllCategories() {

        $data = $this->categories::all();

        return $data;
    }
    /**
     * 
     * Update methods
     * 
     */
    // Update single category method
    public function updateSingleCategory($request,$id) {

        $cat = $this->categories::findOrFail($id);

        if($cat) {
            $cat->update($request->all());

            return $cat;
        }
    }
    /**
     * 
     * Delete methods
     * 
     */
    // Delete single category method
    public function deleteCategory($id) {

        $cat = $this->categories::findOrFail($id);

        if($cat) {
            $cat->delete($id);

            return $cat;
        }
    }
}