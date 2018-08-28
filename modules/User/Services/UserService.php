<?php

namespace Modules\User\Services;

use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\User\Repositories\UserRepository;

class UserService implements UserServiceInterface {

    // Variables
    private $repo;

    // Class constructor
    public function __construct( UserRepository $repo ) {

        $this->repo = $repo;
    }

    /**
     * 
     * Query methods
     * 
     */
    // Get all the users
    public function getAllUsers() {
        // Hit repo 

        $users = $this->repo->getAllUsers();

        return $users;
    }

    // Get single user
    public function getSingleUSer($id) {
        // Hit repo
        $user = $this->repo->getSingleUser($id);

        return $user;
    }
}