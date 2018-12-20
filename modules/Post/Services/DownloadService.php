<?php

namespace Modules\Post\Services;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\Post\Repositories\DownloadRepository;
use Modules\Post\Repositories\PostRepository;

class DownloadService {

    // variables
    private $repo;

    private $postRepo;

    /**
     * 
     * Class constructor
     * 
     */
    public function __construct( DownloadRepository $repo, PostRepository $postRepo ) {

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
    public function createSingleDownload($request) {

        // response checker
        if ( $this->requestChecker($request) ) {

            $data = $this->repo->createSingleDownload($request);

            $response = ResponseBuilder::success($data);
    
            return $response;
        } else {

            $response = ResponseBuilder::error();
        }
    }

    /**
     * 
     * Read methods
     * 
     */
    // Query all downloads
    public function getAllDownloads() {

        $data = $this->repo->getAllDownloads();

        $response = ResponseBuilder::success($data);

        return $response;
    }

    // Request checker
    public function requestChecker ( $request ) {

        // Check request for id
        if ( $request->has('post_id') ) {

            $post_id = $request->input('post_id');

            // Check post for specific id
            if ( $this->postRepo->postExists($post_id) ) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }
}