<?php
namespace Modules\User\Repositories;

use Modules\User\Repositories\Interfaces\AccountsRepositoryInterface;
use Modules\User\Entities\Account;

class AccountsRepository implements AccountsRepositoryInterface {

    // Variables
    protected $accounts;
    protected $userRepo;

    /**
     * 
     * Class constructor
     * 
     */
    public function __constructor( Accounts $accounts ) {

        $this->accounts = $accounts;
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
    // Create single account record
    public function createSingleAccount( $request ) {

        // Hit the repo
        // Create account associated with the user
        $newAccount = Account::create(
            [
                'first_name'=> $request->first_name,
                'last_name'=> $request->last_name,
                'dob'=> $request->dob,
                'gender'=> $request->gender,
                'city'=> $request->city,
                'country'=> $request->country,
                'twitter'=> $request->twitter,
                'facebook'=> $request->facebook,
                'instagram'=> $request->instagram,
                'website'=> $request->website,
                'user_id'=> $request->user_id,
            ]);
        return 'ok';
    }

    /**
     * 
     * Read Methods
     * 
     */
    // Query single account record
    public function getSingleAccount ( $id ) {
        // Account
        return Account::where( 'user_id', $id )->get();
    }

    // Query all accounts
    public function getAllAccounts ( ) {
        // All accounts
        return Account::all();
    }
}