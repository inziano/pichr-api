<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Modules\Post\Services\CategoryService;


class CategoryController extends Controller
{
    
    // Variables
    private $categoryservice;

    /**
     * 
     * Class constructor
     */
    public function __construct( CategoryService $categoryservice ) {

        $this->categoryservice = $categoryservice;
    }
    /**
     * 
     * Category Methods
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function allCategories() {

        return $this->categoryservice->getAllCategories();
    }

   
    /**
     * Get a single post
     * @return Response
     */
    public function singleCategory( Request $request,$id) {

        return $this->categoryservice->getSingleCategory($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function storeCategory(Request $request) {
        
        return $this->categoryservice->createSingleCategory($request);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function updateCategory(Request $request) {

        return $this->categoryservice->updateSingleCategory($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroyCategory() {

        return $this->categoryservice->deleteCategory($id);

    }
}