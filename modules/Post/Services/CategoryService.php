<?php

namespace Modules\Post\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\Post\Repositories\CategoryRepository;

class CategoryService {

    // Variable
    private $repo;

    /**
     * 
     * Class Constructor
     * 
     */
    public function __construct( CategoryRepository $repo) {
        
        $this->repo = $repo;
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

    }
    /**
     * 
     * Read methods
     * 
     */
    // Query single category record 
    public function getSingleCategory($id) {

    }
    // Query all category records
    public function getAllCategories() {

    }
    /**
     * 
     * Update methods
     * 
     */
    // Update single category method
    public function updateSingleCategory($request,$id) {

    }
    /**
     * 
     * Delete methods
     * 
     */
    // Delete single category method
    public function deleteCategory($id) {
        
    }
}