<?php

namespace Modules\Post\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\Post\Repositories\PostRepository;

class PostService {

    // Variables
    private $repo;

    /**
     * 
     * Class Constructor
     * 
     */
    public function __construct( PostRepository $repo) {

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
    
    // Create single post record
    public function createSinglePost($request) {

       // Get image
       $image = $request->file('image');

       // Create name for the image
       $imagename = $request->input('title').time();

       /*
       * Post image to cloud 
       * Returns path to the image location on cloud. 
       */
       $imagepath = $this->storeImage($image, $imagename);

       /*
       * Store image details on db. 
       */
       // Add storage id of image
       $request->request->add(['storage_id'=>$imagepath]);

       // Store data
       $response = $this->repo->createSinglePost($request);

       // Check response and return sth
       if (!$response) {

           return ResponseBuilder::error(ApiCode::IMAGE_UPLOAD_FAILED);

       } else if ($response) {

           return ResponseBuilder::success();

       } else {

           return ResponseBuilder::error(SOMETHING_WENT_WRONG);
       }

    }

    /**
     * 
     * Read methods
     * 
     */

    // Query single post record 
    public function getSinglePost($id) {

        $response = $this->repo->getSinglePost($id);

        if ( $response ) {

            return ResponseBuilder::success($response);

        } else {
            // Error
            return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
        }
    }

    // Query all post records
    public function getAllPosts() {

        $response = $this->repo->getAllPosts();

        if ( $response ) {

            return ResponseBuilder::success($response);

        } else {

            return ResponseBuilder::error(ApiCode::POSTS_NOT_FOUND);
        }
    }

    /**
     * 
     * Update methods
     * 
     */

    // Update single post method
    public function updateSinglePost($request,$id) {

    }

    /**
     * 
     * Delete methods
     * 
     */

    // Delete single post method
    public function deletePost($id) {

    }

    /**
     * 
     * Image Manipulation Methods
     * 
     */
    // Check image
    public function checkImage($request) {

        if (!$request->hasFile('image')) {

            return ResponseBuilder::error(Apicode::IMAGE_NOT_FOUND);

        } else if(!$request->file('image')->isValid()) {

            return ResponseBuilder::error(ApiCode::IMAGE_NOT_VALID);

        } else if ($request->hasFile('image')) {

            return $this->createPost($request);

        } else {

            return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
        }
    }

    // Store Image
    public function storeImage($image,$imagename) {

        // Store image
        return Storage::cloud()->putFileAs('uploads',$image,$imagename);
    }
}