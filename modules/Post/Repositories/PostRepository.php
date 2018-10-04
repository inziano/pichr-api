<?php

namespace Modules\Post\Repositories;

use Modules\Post\Repositories\Interfaces\PostRepositoryInterface;

use Modules\Post\Entities\Post;

class PostRepository implements PostRepositoryInterface {

    /**
     * Class constructor
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
    
    // Create single post record
    public function createSinglePost($request) {

        $data = Post::create($request->all());

        return $data;
    }

    /**
     * 
     * Read methods
     * 
     */

    // Query single post record 
    public function getSinglePost($id) {

        $data = Post::where('id',$id)->get();

        return $data;
    }

    // Query all post records
    public function getAllPosts() {

        $data = Post::all();

        return $data;
    }

    /**
     * 
     * Update methods
     * 
     */

    // Update single post method
    public function updateSinglePost($request,$id) {

        $pst = Post::findOrFail($request->id);

        if($pst) {
            $pst->update($request->all());

            return $pst;
        }
    }

    /**
     * 
     * Delete methods
     * 
     */

    // Delete single post method
    public function deletePost($id) {

        $pst = Post::findOrFail($id);

        if($pst) {
            $pst->delete($id);

            return $pst;
        }

    }
}