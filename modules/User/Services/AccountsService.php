<?php

namespace Modules\User\Services;

use App\ApiCode;
use App\Events\AccountCreated;
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
        $userExists = $this->user->userExists($request->user_id);

        // Check if user has another account registered
        // Returns true if account found false otherwise
        $hasAccount = $this->repo->getSingleAccount( $request->user_id )->isNotEmpty();

        
        if ( $userExists === false ) {
            // User does not exist
            return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);

        } else if ( $userExists === true && $hasAccount === true ) {
            // Account exists
            // return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
            return 'account exists';

        } else if ( $userExists === false && $hasAccount === true) {
            // User does not exist, account exists
            // return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
            return 'account exists';
        } else {
            // Default case, user exists, account non-existent
            // Create account
            $acct = $this->repo->createSingleAccount($request);

            // check if ok
            switch( $acct ) {
                // Account created
                case 'ok':
                    // Fire event
                    event( new AccountCreated( $request->user_id ) );
                    // return success response
                    return ResponseBuilder::success($acct);
                    break;

                // Account not created
                default:
                    return ResponseBuilder::error(ApiCode::SOMETHING_WENT_WRONG);
                    break;
            }
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

        // Return
        return ResponseBuilder::success( $acct );
    }
    
    // All accounts
    public function getAllAccounts () {
        
        // Hit repo
        $acct = $this->repo->getAllAccounts();

        // Return
        return ResponseBuilder::success( $acct );
    }
}