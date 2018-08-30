<?php

namespace Modules\User\Services;

use Illuminate\Http\Response;
use \MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\User\Repositories\UserRepository;

class UserService implements UserServiceInterface {

    // Variables
    private $repo;
    private $api_response;

    // Class constructor
    public function __construct( UserRepository $repo, ResponseBuilder $api_response ) {

        $this->repo = $repo;

        $this->response = $api_response;
    }

    /**
     * 
     * Create Methods
     */
    // Create single user
    public function createSingleUser($request) {

        // Ensure request has all the necessary params
        // Hash password
        // Add password to request
        // Hit repo
        $user = $this->repo->createSingleUser($request);

        // Build json response
        $response = $this->response::success($user);

        // dd($response);

        // Return response
        return $response;
    }
    /**
     * 
     * Read methods
     * 
     */
    // Get all the users
    public function getAllUsers() {
        
        // Hit repo 
        $users = $this->repo->getAllUsers();

        // Build response
        $response = $this->response::success($users);

        return $response;
    }

    // Get single user
    public function getSingleUSer($id) {

        // Hit repo
        $user = $this->repo->getSingleUser($id);

        // Build response
        $response = $this->response::success($user);

        return $response;
    }
}