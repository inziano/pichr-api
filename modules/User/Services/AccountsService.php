<?php

namespace Modules\User\Services;

use \MarcinOrlowski\ResponseBuilder\ResponseBuilder;

use Modules\User\Services\Interfaces\AccountsServiceInterface;
use Modules\User\Repositories\AccountsRepository;
use Modules\User\Repositories\UserRepository;

class AccountsService implements AccountsServiceInterface {

    // Variables
    private $repo;
    private $api_response;
    private $user;

    /**
     * 
     * Class constructor
     */
    public function __construct( AccountsRepository $repo, ResponseBuilder $api_response , UserRepository $user) {

        $this->repo = $repo;
        $this->user = $user;
        $this->response = $api_response;
    }

    /**
     * 
     * DB access methods
     * 
     */

    /**
     *
     * Create methods 
     */
    public function createSingleAccount ( $request ) {

        // Check if the user exists
        $val= $this->user->UserExists($request->user_id);

        if ( $val ) {

            // Hit repo  
            $acct = $this->repo->createSingleAccount($request);

            // Build response
            $response = $this->response::success($acct);

            // Return
            return $response;
        }

        
    }

    /**
     * 
     * Read methods
     * 
     */
    // Single account
    public function getSingleAccount ( $id ) {
        
        // Hit repo
        $acct = $this->repo->getSingleAccount( $id );

        // Build response
        $response = $this->response::success($acct);

        // Return
        return $response;
    }
    
    // All accounts
    public function getAllAccounts ( ) {
        
        // Hit repo
        $acct = $this->repo->getAllAccounts( );

        // Build response
        $response = $this->response::success($acct);

        // Return
        return $response;
    }
}