<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Modules\Post\Services\PostService;
use Modules\Post\Services\CategoryService;


class PostController extends Controller
{
    
    // Variables
    private $postservice;
    private $categoryservice;

    /**
     * 
     * Class constructor
     */
    public function __construct( CategoryService $categoryservice, PostService $postservice ) {

        $this->postservice = $postservice;

        $this->categoryservice = $categoryservice;
    }

    /**
     * 
     * Post methods
     * 
     */

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function allPosts() {

        return $this->postservice->getAllPosts();
    }

    /**
     * Get a single post
     * @return Response
     */
    public function singlePost( Request $request,$id) {

        return $this->postservice->getSinglePost($id);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function storePost(Request $request) {
        
        return $this->postservice->createSinglePost($request);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function updatePost(Request $request) {

        return $this->postservice->updateSinglePost($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroyPost() {

        return $this->postservice->deletePost($id);

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
